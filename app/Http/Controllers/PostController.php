<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function createPost(Request $request) {

        //validating of uploaded blog post
        $validatedPost = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        // saving the vlaidated post
        $validatedPost['title'] = strip_tags($validatedPost['title']);
        $validatedPost['body'] = strip_tags($validatedPost['body']);
        $validatedPost['user_id'] = auth()->id();
        Post::create($validatedPost);
        return redirect('/');
    }
}
