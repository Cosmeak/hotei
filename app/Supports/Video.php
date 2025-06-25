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
        $outputVideo = $outputPath.'video.webm';
        $outputAudio = $outputPath.'audio_original.mp3';

        if (! file_exists($outputPath)) {
            Log::info('Creating videos directory.');
            mkdir($outputPath, 0755, true);
        }

        try {
            $ffmpeg = FFMpeg::create([
                'timeout' => 0,
                'ffprobe.timeout' => 0,
            ]);
            Log::info('FFmpeg initialized.');
            $openedFile = $ffmpeg->open($filePath);

            Log::info('Converting video to VP9 format...');

            $t1 = hrtime(true);

            $threads = max(1, (int) trim(shell_exec('nproc')));

            $vp9 = (new WebM)
                ->setAudioKiloBitrate(96)
                ->setAdditionalParameters([
                    '-crf',      '37',
                    '-b:v',      '0',
                    '-cpu-used', '8',
                    '-deadline', 'realtime',
                    '-row-mt',   '1',
                    '-tile-columns', '2',
                    '-threads',  (string) $threads,
                ]);

            $openedFile->save($vp9, $outputVideo);

            $d1 = (hrtime(true) - $t1) / 1e9;
            Log::info("↳ [OPT] video → VP9 : {$d1}s");

            Log::info('Video saved: '.$outputVideo);

            Log::info('Extracting audio...');

            $t2 = hrtime(true);

            $openedFile->save(new Mp3, $outputAudio);
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
