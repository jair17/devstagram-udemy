<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post, Request $request){

    }
    public function destroy(Post $post, Request $request){

        return back();
    }
}
