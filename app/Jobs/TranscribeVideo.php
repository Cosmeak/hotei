<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Codewithkyrian\Whisper\Whisper;
use function Codewithkyrian\Whisper\readAudio;
use Symfony\Component\Console\Command\Command;
use Illuminate\Support\Facades\Log;

class TranscribeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries  = 5;
    public int $backoff = 10;

    public function __construct(private string $audioPath)
    {
        $this->onQueue('transcription');
    }

    private function toWav16k(string $src): string
    {
        $dst = storage_path('app/tmp_' . uniqid() . '.wav');

        $cmd = sprintf(
            'ffmpeg -y -loglevel error -i %s -ac 1 -ar 16000 '
            .'-af "apad=pad_dur=30" -t 30 -c:a pcm_s16le %s',
            escapeshellarg($src),
            escapeshellarg($dst)
        );
        exec($cmd, $out, $ret);

        if ($ret !== 0 || !is_file($dst)) {
            Log::error('ffmpeg failed', compact('cmd', 'out', 'ret'));
            throw new \RuntimeException('ffmpeg conversion failed');
        }
        return $dst;
    }

    public function handle(): int
    {
        Log::debug('START transcribe', ['audio' => $this->audioPath]);

        $source = storage_path('app/' . ltrim($this->audioPath, '/'));
        if (! is_file($source)) {
            throw new \RuntimeException("Audio file not found: {$source}");
        }

        $wav = $this->toWav16k($source);

        $outBase = storage_path('app/tmp_' . uniqid());
        $cmd = sprintf(
            '/tmp/whisper-src/build/bin/whisper-cli -m %s -f %s -otxt -l auto -nt -of %s',
            escapeshellarg(base_path('whisper_models/tiny.bin')),
            escapeshellarg($wav),
            escapeshellarg($outBase)
        );
        exec($cmd, $cliOut, $ret);

        @unlink($wav);

        if ($ret !== 0 || ! is_file($outBase . '.txt')) {
            Log::error('whisper-cli failed', compact('cmd', 'cliOut', 'ret'));
            throw new \RuntimeException('whisper-cli failed (see logs)');
        }

        $text = trim(file_get_contents($outBase . '.txt'));
        @unlink($outBase . '.txt');

        $dest = storage_path('app/public/' . dirname($this->audioPath) . '/transcription.txt');
        is_dir(dirname($dest)) || mkdir(dirname($dest), 0777, true);
        file_put_contents($dest, $text);

        Log::debug('END transcribe', ['written' => $dest]);
        return Command::SUCCESS;
    }

}
