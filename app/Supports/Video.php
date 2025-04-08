<?php

namespace App\Supports;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Video\WebM;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class Video
{
    /**
     * Transform a video file into an optimized video and a optimized audio file
     */
    public static function optimize(UploadedFile $tempFile, string $path): array
    {
        Log::info("Starting the optimize method.");

        $path = storage_path("app/public/" . $path . "/");
        $outputVideo = $path . "video.webm";
        $outputAudio = $path . "audio_original.mp3";

        if (!file_exists($path)) {
            Log::info("Creating videos directory.");
            mkdir($path, 0755, true);
        }

        try {
            $ffmpeg = FFMpeg::create();
            Log::info("FFmpeg initialized.");
            $openedFile = $ffmpeg->open($tempFile->getPathname());

            Log::info("Converting video to VP9 format...");
            $openedFile->save(new WebM(), $outputVideo);
            Log::info("Video saved: " . $outputVideo);

            Log::info("Extracting audio...");
            $openedFile->save(new Mp3(), $outputAudio);
            Log::info("Audio saved: " . $outputAudio);

            if (file_exists($tempFile->getPathname())) {
                unlink($tempFile);
                Log::info("Original video file deleted: " . $tempFile);
            }
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
