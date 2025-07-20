<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        // TODO: add element to reply to another comment
        $validated = $request->validate([
            'text' => ['required', 'string'],
            'scope' => ['required', 'string', 'in:project,course'],
            'scope_id' => ['required', 'string'],
        ]);

        $user = Auth::user();
        $comment = new Comment;
        $comment->user_id = $user->id;
        $comment->text = $validated['text'];
        $comment->{$validated['scope'] . '_id'} = $validated['scope_id'];
        $comment->save();

        return back();
    }
}
