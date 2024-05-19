<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\CommentNotification;
use App\Notifications\FollowNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class FollowerController extends Controller
{
    public function store(User $user){
        $user->followers()->attach(auth()->user()->id);
        Notification::send($user, new FollowNotification($user));
        return back();
    }

    public function destroy(User $user){
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
