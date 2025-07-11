<?php

namespace App\Supports;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\Log;

class Video
{
    /**
     * Transform a video file into an optimized video and a optimized audio file
     */
    public static function optimize(string $filePath, string $outputPath): array
    {
        Log::info('Starting the optimize method.');

        $t0 = hrtime(true);
        Log::info('↳ [OPT] start');

        $outputPath = storage_path('app/'.rtrim($outputPath, '/').'/');
        $outputVideo = $outputPath.'video.mp4';
        $outputAudio = $outputPath.'audio_original.mp3';

        if (! file_exists($outputPath)) {
            Log::info('Creating videos directory.');
            mkdir($outputPath, 0755, true);
        }

        try {
            $threads = 4;

            Log::info('Converting video to H.264 format...');

            $t1 = hrtime(true);

            $cmd1 = sprintf(
                'ffmpeg -y -loglevel error -i %s -c:v libx264 -preset veryfast -crf 28 -threads %d -c:a aac -b:a 128k %s',
                escapeshellarg($filePath),
                $threads,
                escapeshellarg($outputVideo)
            );

            Log::info('[OPT] Running ffmpeg command', ['cmd' => $cmd1]);

            exec($cmd1, $out1, $ret1);

            Log::info('[OPT] ffmpeg return code', ['ret' => $ret1]);
            Log::info('[OPT] ffmpeg output', ['out' => $out1]);

            if ($ret1 !== 0) {
                Log::error('[OPT] Video encoding failed', compact('cmd1', 'out1'));
                throw new \RuntimeException('Video encoding failed');
            }

            $d1 = (hrtime(true) - $t1) / 1e9;
            Log::info("↳ [OPT] video → H.264 : {$d1}s");

            Log::info('Video saved: '.$outputVideo);

            Log::info('Extracting audio...');

            $t2 = hrtime(true);

            $cmd2 = sprintf(
                'ffmpeg -y -loglevel error -i %s -vn -acodec libmp3lame -ab 128k %s',
                escapeshellarg($filePath),
                escapeshellarg($outputAudio)
            );

            exec($cmd2, $out2, $ret2);
            if ($ret2 !== 0) {
                Log::error('[OPT] Audio extraction failed', compact('cmd2', 'out2'));
                throw new \RuntimeException('Audio extraction failed');
            }

            Log::info('Audio saved: '.$outputAudio);

            $d2 = (hrtime(true) - $t2) / 1e9;
            Log::info("↳ [OPT] audio → MP3 : {$d2}s");

        } catch (\Exception $e) {
            Log::error('Error processing the video: '.$e->getMessage());
            throw $e;
        }

        $total = (hrtime(true) - $t0) / 1e9;
        Log::info("↳ [OPT] done in {$total}s");

        return [
            'video' => $outputVideo,
            'audio' => $outputAudio,
        ];
    }
}
