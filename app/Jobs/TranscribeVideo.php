<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Command\Command;

class TranscribeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 2;

    public int $backoff = 10;

    public function __construct(private string $audioPath)
    {
        $this->onQueue('transcription');
    }

    public function handle(): int
    {
        Log::debug('START transcribe', ['audio' => $this->audioPath]);

        $t0 = hrtime(true);

        $source = storage_path('app/'.ltrim($this->audioPath, '/'));
        if (! is_file($source)) {
            throw new \RuntimeException("Audio file not found: {$source}");
        }

        $wav = $this->toWav16k($source);
        [$text, $lang] = $this->transcribeChunks($wav);
        @unlink($wav);

        $destDir = storage_path('app/public/'.dirname($this->audioPath)."/{$lang}");
        if (! is_dir($destDir)) {
            mkdir($destDir, 0777, true);
        }

        file_put_contents($destDir.'/transcription.txt', $text);

        $total = (hrtime(true) - $t0) / 1e9;
        Log::info("↳ [TRS] transcription done in {$total} s");

        Log::debug('END transcribe', ['written' => $destDir.'/transcription.txt']);

        return Command::SUCCESS;
    }

    private function toWav16k(string $src): string
    {
        $dst = storage_path('app/tmp_'.uniqid().'.wav');

        exec(sprintf(
            'ffmpeg -y -loglevel error -i %s -ac 1 -ar 16000 -c:a pcm_s16le %s',
            escapeshellarg($src),
            escapeshellarg($dst)
        ), $out, $ret);

        if ($ret !== 0 || ! is_file($dst)) {
            Log::error('ffmpeg failed', compact('src', 'dst', 'out', 'ret'));
            throw new \RuntimeException('ffmpeg conversion failed');
        }

        return $dst;
    }

    private function transcribeChunks(string $wav): array
    {
        $chunkDir = storage_path('app/tmp_'.uniqid());
        mkdir($chunkDir);

        exec(sprintf(
            'ffmpeg -y -loglevel error -i %s -f segment -segment_time 60 -ac 1 -ar 16000 %s/%%03d.wav',
            escapeshellarg($wav),
            escapeshellarg($chunkDir)
        ));

        $model = base_path('whisper_models/ggml-tiny.bin');
        $buffer = '';

        $langDetected = 'unk';
        $firstChunk = true;

        foreach (glob("$chunkDir/*.wav") as $chunk) {
            $out = $chunk.'.out';
            $cmd = sprintf(
                '/usr/local/bin/whisper-cli -m %s -f %s -otxt -l auto -nt -of %s 2>&1',
                escapeshellarg($model),
                escapeshellarg($chunk),
                escapeshellarg($out)
            );
            $cliOut = [];
            exec($cmd, $cliOut, $ret);
            if ($ret !== 0) {
                Log::error('Whisper CLI failed', compact('cmd', 'ret', 'cliOut'));
                throw new \RuntimeException('Whisper CLI failed');
            }

            if ($firstChunk) {
                foreach ($cliOut as $line) {
                    if (preg_match('/auto-detected language:\s+(\w+)/i', $line, $m)) {
                        $langDetected = strtolower($m[1]);
                        break;
                    }
                }
                $firstChunk = false;
            }

            $buffer .= PHP_EOL.trim(file_get_contents($out.'.txt'));
            @unlink($out);
            @unlink($out.'.txt');
            @unlink($chunk);
        }

        rmdir($chunkDir);

        return [
            trim(str_replace('[BLANK_AUDIO]', '', $buffer)),
            $langDetected,
        ];
    }
}
