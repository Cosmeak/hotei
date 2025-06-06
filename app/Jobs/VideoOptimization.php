<?php

namespace App\Jobs;

use App\Supports\Video;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique; 
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\TranscribeVideo;

class VideoOptimization implements ShouldQueue, ShouldBeUnique
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 7200;
    public int $tries   = 1;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $filePath,
        private string $outputPath
    ) {
        $this->onQueue("video");
    }

    public function uniqueId(): string
    {
        return md5($this->filePath);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $paths = Video::optimize($this->filePath, $this->outputPath);

        TranscribeVideo::dispatch(
            str_replace(storage_path('app/'), '', $paths['audio'])
        );
    }
}
