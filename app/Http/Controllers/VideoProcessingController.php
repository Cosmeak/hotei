<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Helpers\Video;
use Illuminate\Http\Request;

class VideoProcessingController extends Controller
{
    protected $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    public function index(): Response
    {
        return Inertia::render('VideoProcessing');
    }

    public function store(Request $request)
    {
        $request->validate([
            'video' => 'required|file|mimes:mp4|max:204800',
        ]);
    
        if (!$request->hasFile('video')) {
            \Log::error('No file uploaded');
            return response()->json(['error' => 'No file uploaded'], 400);
        }
    
        try {
            $videoFile = $request->file('video');
            \Log::info('Video file received: ' . $videoFile->getClientOriginalName());
    
            $paths = $this->video->optimize($videoFile);
    
            return response()->json([
                'message' => 'Video processed successfully',
                'video_url' => asset('storage/videos/' . basename($paths['video'])),
                'audio_url' => asset('storage/audios/' . basename($paths['audio'])),
            ]);
        } catch (\Exception $e) {
            \Log::error('Error processing video: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to process video'], 500);
        }
    }
    


}