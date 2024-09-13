<?php

namespace App\Helpers;

use FFMpeg;
use FFMpeg\Format\Audio\Opus;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\Storage;

class Video
{
    public function optimize($videoFile)
    {

        $filename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
        $outputVideo = storage_path('app/public/videos/') . $filename . '_vp9.webm';
        $outputAudio = storage_path('app/public/videos/') . $filename . '_audio.opus';


        if (!file_exists(storage_path('app/public/videos/'))) {
            mkdir(storage_path('app/public/videos/'), 0755, true);
        }


        $videoFile->move(storage_path('app/public/videos/'), $videoFile->getClientOriginalName());


        $inputPath = storage_path('app/public/videos/') . $videoFile->getClientOriginalName();


        $ffmpeg = FFMpeg::create();
        $video = $ffmpeg->open($inputPath);


        $video->save(new WebM(), $outputVideo);


        $audio = $ffmpeg->open($inputPath);
        $audio->save(new Opus(), $outputAudio);

        return [
            'video' => $outputVideo,
            'audio' => $outputAudio,
        ];
    }
}
