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

class TranscribeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $audioPath;
    protected string $language;

    /**
     * Create a new job instance.
     */
    public function __construct(string $audioPath, string $language)
    {
        $this->audioPath = $audioPath;
        $this->language = $language;
        $this->onQueue('transcription');
    }

    /**
     * Execute the job.
     */
    public function handle(): int
    {
        if (!extension_loaded('ffi')) {
            throw new \RuntimeException('ffi extension is not loaded.');
        }

        $fullPath = storage_path('app/public/' . $this->audioPath);

        if (!file_exists($fullPath)) {
            throw new \RuntimeException('Audio file does not exist at: ' . $fullPath);
        }

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

        $filename = storage_path('app/courses_data/' . $this->language . '/transcription.txt');

        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0777, true);
        }

        file_put_contents($filename, trim($resultText));

        return Command::SUCCESS;
    }
}