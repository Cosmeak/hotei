<?php

namespace App\Jobs;

use App\Helpers\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Http\UploadedFile;

class VideoOptimization implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(UploadedFile $file, string $path)
    {
        $this->onQueue('video');
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Video::optimize($this->file, $this->path);
    }
}
