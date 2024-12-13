<?php

namespace App\Helpers;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Video
{
    public function optimize($videoFile)
    {
        Log::info('Starting the optimize method.');

        $uuid = Str::uuid();
        $videoDirectory = storage_path('app/public/videos/');
        $audioDirectory = storage_path('app/public/audios/');

        $outputVideo = $videoDirectory . $uuid . '_vp9.webm';
        $outputAudio = $audioDirectory . $uuid . '_audio.mp3';

        if (!file_exists($videoDirectory)) {
            Log::info('Creating videos directory.');
            mkdir($videoDirectory, 0755, true);
        }
        if (!file_exists($audioDirectory)) {
            Log::info('Creating audios directory.');
            mkdir($audioDirectory, 0755, true);
        }

        Log::info('Moving the video file to the videos directory.');
        $videoFile->move($videoDirectory, $uuid . '.mp4');

        $inputPath = $videoDirectory . $uuid . '.mp4';
        Log::info('Input video path: ' . $inputPath);

        try {
            $ffmpeg = FFMpeg::create();
            Log::info('FFmpeg initialized.');

            $video = $ffmpeg->open($inputPath);
            Log::info('Converting video to VP9 format...');
            $video->save(new WebM(), $outputVideo);
            Log::info('Video saved: ' . $outputVideo);

            Log::info('Extracting audio...');
            $audio = $ffmpeg->open($inputPath);
            $audio->save(new Mp3(), $outputAudio);
            Log::info('Audio saved: ' . $outputAudio);

            if (file_exists($inputPath)) {
                unlink($inputPath);
                Log::info('Original video file deleted: ' . $inputPath);
            }

            return [
                'video' => $outputVideo,
                'audio' => $outputAudio,
            ];
        } catch (\Exception $e) {
            Log::error('Error processing the video: ' . $e->getMessage());
            throw $e;
        }
    }
}
