<?php

namespace App\Helpers;

use FFMpeg\FFMpeg;
use FFMpeg\Format\Audio\Mp3;
use FFMpeg\Format\Video\WebM;
use Illuminate\Support\Facades\Log;

class Video
{
    public function optimize($videoFile)
    {
        Log::info('Début de la méthode optimize.');

        $filename = pathinfo($videoFile->getClientOriginalName(), PATHINFO_FILENAME);
        $videoDirectory = storage_path('app/public/videos/');
        $audioDirectory = storage_path('app/public/audios/');

        $outputVideo = $videoDirectory . $filename . '_vp9.webm';
        $outputAudio = $audioDirectory . $filename . '_audio.mp3';

        if (!file_exists($videoDirectory)) {
            Log::info('Création du dossier videos.');
            mkdir($videoDirectory, 0755, true);
        }
        if (!file_exists($audioDirectory)) {
            Log::info('Création du dossier audios.');
            mkdir($audioDirectory, 0755, true);
        }

        Log::info('Déplacement du fichier vidéo dans le dossier videos.');
        $videoFile->move($videoDirectory, $videoFile->getClientOriginalName());

        $inputPath = $videoDirectory . $videoFile->getClientOriginalName();
        Log::info('Chemin de la vidéo d\'entrée : ' . $inputPath);

        try {
            $ffmpeg = FFMpeg::create();
            Log::info('FFmpeg initialisé.');

            $video = $ffmpeg->open($inputPath);
            Log::info('Conversion de la vidéo en cours...');
            $video->save(new WebM(), $outputVideo);
            Log::info('Vidéo sauvegardée : ' . $outputVideo);

            Log::info('Extraction de l\'audio en cours...');
            $audio = $ffmpeg->open($inputPath);
            $audio->save(new Mp3(), $outputAudio);
            Log::info('Audio sauvegardé : ' . $outputAudio);

            // Supprimez le fichier d'origine après le traitement
            if (file_exists($inputPath)) {
                unlink($inputPath);
                Log::info('Fichier vidéo d\'origine supprimé : ' . $inputPath);
            }

            return [
                'video' => $outputVideo,
                'audio' => $outputAudio,
            ];
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement de la vidéo : ' . $e->getMessage());
            throw $e;
        }
    }
}
