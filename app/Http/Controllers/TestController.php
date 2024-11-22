<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Helpers\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    protected $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function index(): Response
    {
        return Inertia::render('Test');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4|max:204800',
        ]);

        if (!$request->hasFile('video')) {
            Log::error('Aucun fichier n’a été téléchargé');
            return back()->with([
                'error' => 'Aucun fichier n’a été téléchargé'
            ]);
        }

        try {
            $videoFile = $request->file('video');

            Log::info('Fichier vidéo reçu : ' . $videoFile->getClientOriginalName());

            $paths = $this->video->optimize($videoFile);

            return back()->with([
                'message' => 'Vidéo traitée avec succès',
                'video_url' => asset('storage/videos/' . basename($paths['video'])),
                'audio_url' => asset('storage/audios/' . basename($paths['audio'])),
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lors du traitement de la vidéo : ' . $e->getMessage());

            return back()->with([
                'error' => 'Échec du traitement de la vidéo',
            ]);
        }
    }
}
