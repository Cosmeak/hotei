<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TranscriptionController extends Controller
{
    public function transcribeVideo(Request $request)
    {
        $request->validate(['videoPath' => 'required|string']);
        $fullPath = public_path($request->input('videoPath'));
        $whisper = '/usr/local/bin/whisper';
        $model = base_path('whisper_models/ggml-base.bin');
        $cmd = escapeshellcmd("$whisper --model $model --file \"$fullPath\" --language fr --output-txt");
        shell_exec($cmd);
        $txt = preg_replace('/\.[^.]+$/', '.txt', $fullPath);
        $res = file_exists($txt) ? file_get_contents($txt) : '';
        if (file_exists($txt)) unlink($txt);
        return response()->json(['transcription' => $res]);
    }
}
