<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return Post::latest()->get();
    }

    function store(Request $request)
    {
        $post =   Post::create([
            'name' => $request->name
        ]);

        if ($post) {
            return "CREATED";
        }
    }

    public function show($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return $post;
        } else {
            return "POST NOT FOUND!";
        }
    }


    public function update(Request $request, $id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            $post->update($request->all());
        } else {
            return "POST NOT FOUND!";
        }
    }

    public function delete($id)
    {
        $post = Post::whereId($id)->first();

        if ($post) {
            return $post->delete();
        } else {
            return "POST NOT FOUND!";
        }
    }
}
