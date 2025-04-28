<?php

namespace App\Jobs;

use App\Supports\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\TranscribeVideo;

class VideoOptimization implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $filePath;
    protected string $path;
    protected string $language;

    /**
     * Create a new job instance.
     */
    public function __construct(string $filePath, string $path, string $language)
    {
        $this->filePath = $filePath;
        $this->path = $path;
        $this->language = $language;
        $this->onQueue('video');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $paths = Video::optimize($this->filePath, $this->path);

        TranscribeVideo::dispatch($paths['audio'], $this->language);
    }
}