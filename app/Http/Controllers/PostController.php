<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{   

    public function deletePost(Post $post) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $post->delete($post);
        return redirect('/');
    }

    public function updatePost(Post $post, Request $request) {
        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }

        $validatedFields = $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $validatedFields['title'] = strip_tags($validatedFields['title']);
        $validatedFields['body'] = strip_tags($validatedFields['body']);

        $post->update($validatedFields);
        return redirect('/');
    }

    public function editPost(Post $post) {

        if(auth()->user()->id !== $post['user_id']) {
            return redirect('/');
        }
        return view('edit-post', ['post' => $post]);
    }

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
