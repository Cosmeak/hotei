<?php

namespace App\Jobs;

use App\Supports\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class VideoOptimization implements ShouldBeUnique, ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $timeout = 7200;

    public int $tries = 1;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private string $filePath,
        private string $outputPath
    ) {
        $this->onQueue('video');
        Log::info('Constructed job', ['file' => $filePath]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('VideoOptimization is ALIVE', [
            'file' => $this->filePath,
        ]);

        $paths = Video::optimize($this->filePath, $this->outputPath);

        TranscribeVideo::dispatch(
            str_replace(storage_path('app/'), '', $paths['audio'])
        );
    }
}
