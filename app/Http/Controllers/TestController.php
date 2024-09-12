<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Helpers\Video;
use Illuminate\Http\Request;

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
                \Log::error('No file uploaded');
                return response()->json(['error' => 'No file uploaded'], 400);
            }

            try {
                $videoFile = $request->file('video');
                
                \Log::info('Video file received: ' . $videoFile->getClientOriginalName());


                $paths = $this->video->optimize($videoFile);

                return response()->json([
                    'message' => 'Video processed successfully',
                    'video_url' => $paths['video_url'],
                    'audio_url' => $paths['audio_url'],
                ]);
            } catch (\Exception $e) {
                
                \Log::error('Error processing video: ' . $e->getMessage());

                return response()->json(['error' => 'Failed to process video'], 500);
            }
        }


}
