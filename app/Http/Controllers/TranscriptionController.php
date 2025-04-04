<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CodeWithKyrian\Whisper\Whisper;
use function CodeWithKyrian\Whisper\readAudio;

class TranscriptionController extends Controller
{
    public function transcribeVideo(Request $request)
    {
        $request->validate(['videoPath' => 'required|string']);

        $fullPath = public_path($request->input('videoPath'));

        $whisper = Whisper::fromPretrained(
            'base',
            baseDir: base_path('whisper_models')
        );

        $audioData = readAudio($fullPath);

        $segments = $whisper->transcribe($audioData, 4);

        $resultText = '';
        foreach ($segments as $seg) {
            $resultText .= $seg->text . ' ';
        }

        return response()->json([
            'transcription' => trim($resultText)
        ]);
    }
}
