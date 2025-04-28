<?php

namespace App\Supports;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class Video
{
    /**
     * Transform a video file into an optimized video and a optimized audio file
     */
    public static function optimize(
        UploadedFile $file,
        string $outputPath
    ): array {
        Log::info("Starting the optimize method.");

        $outputPath = storage_path("app/" . rtrim($outputPath, "/") . "/");
        $outputVideo = $outputPath . "video.webm";
        $outputAudio = $outputPath . "audio_original.mp3";

        if (!file_exists($outputPath)) {
            Log::info("Creating videos directory.");
            mkdir($path, 0755, true);
        }

        try {
            $ffmpeg = FFMpeg::create();
            Log::info("FFmpeg initialized.");
            $openedFile = $ffmpeg->open($file->getPathname());

            Log::info("Converting video to VP9 format...");
            $openedFile->save(new WebM(), $outputVideo);
            Log::info("Video saved: " . $outputVideo);

            Log::info("Extracting audio...");
            $openedFile->save(new Mp3(), $outputAudio);
            Log::info("Audio saved: " . $outputAudio);
        } catch (\Exception $e) {
            Log::error("Error processing the video: " . $e->getMessage());
            throw $e;
        }

        return [
            "video" => $outputVideo,
            "audio" => $outputAudio,
        ];
    }
}
