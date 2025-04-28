<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Codewithkyrian\Whisper\Whisper;
use function Codewithkyrian\Whisper\readAudio;

class TranscribeVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $audioPath,
        private string $language
    ) {
        $this->onQueue("transcription");
    }

    /**
     * Execute the job.
     */
    public function handle(): int
    {
        if (!extension_loaded("ffi")) {
            throw new \RuntimeException("ffi extension is not loaded.");
        }

        $fullPath = storage_path("app/public/" . $this->audioPath);

        if (!file_exists($fullPath)) {
            throw new \RuntimeException(
                "Audio file does not exist at: " . $fullPath
            );
        }

        $whisper = Whisper::fromPretrained(
            "base",
            baseDir: base_path("whisper_models")
        );

        $audioData = readAudio($fullPath);
        $segments = $whisper->transcribe($audioData, 4);

        $output = "";
        foreach ($segments as $segment) {
            $output .= $segment->text . " ";
        }

        $path = explode($audioPath, "/");
        unset(array_key_last($path));
        $path = implode($path, "/");
        $filename = storage_path("{$path}/transcription_{$this->language}.txt");

        if (!is_dir(dirname($filename))) {
            mkdir(dirname($filename), 0777, true);
        }

        file_put_contents($filename, trim($output));
    }
}
