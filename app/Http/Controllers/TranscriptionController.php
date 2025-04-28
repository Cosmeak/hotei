<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\TranscribeVideo;

class TranscriptionController extends Controller
{
    public function transcribeVideo(Request $request)
    {
        $request->validate([
            'videoPath' => 'required|string',
        ]);

        TranscribeVideo::dispatch($request->input('videoPath'));

        return response()->json([
            'message' => 'transcription job dispatched successfully.'
        ]);
    }
}
