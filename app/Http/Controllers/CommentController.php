<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use App\Notifications\CommentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;

class CommentController extends Controller
{
    public function store(User $user, Post $post, Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $comment = Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
            Notification::send($user, new CommentNotification($comment));
        return back()->with('message', __('Comment published successfully!'));
    }
}
