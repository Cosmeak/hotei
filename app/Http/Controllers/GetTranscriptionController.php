<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GetTranscriptionController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'videoPath' => 'required|string',
        ]);

        $filename = 'transcriptions/' . md5($request->input('videoPath')) . '.txt';

        if (!Storage::disk('local')->exists($filename)) {
            return response()->json([
                'transcription' => null
            ]);
        }

        $text = Storage::disk('local')->get($filename);

        return response()->json([
            'transcription' => trim($text)
        ]);
    }
}