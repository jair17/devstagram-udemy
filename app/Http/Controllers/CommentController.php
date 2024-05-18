<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(User $user,Post $post,Request $request){

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        Comment::create([
            'comment' => $request->input('comment'),
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return back()->with('message', __('Comment published successfully!'));
    }
}
