<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use CodeWithKyrian\Whisper\Whisper;
use function CodeWithKyrian\Whisper\readAudio;

class TranscribeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $videoPath;

    /**
     * Create a new job instance.
     */
    public function __construct(string $videoPath)
    {
        $this->videoPath = $videoPath;
        $this->onQueue('transcription');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $fullPath = public_path($this->videoPath);

        $whisper = Whisper::fromPretrained(
            'base',
            baseDir: base_path('whisper_models')
        );

        $audioData = readAudio($fullPath);

        $segments = $whisper->transcribe($audioData, 4);

        $resultText = '';
        foreach ($segments as $seg) {
            $resultText .= $seg->text . ' ';
        }

        $filename = storage_path('app/transcriptions/' . md5($this->videoPath) . '.txt');
        file_put_contents($filename, trim($resultText));
    }
}
