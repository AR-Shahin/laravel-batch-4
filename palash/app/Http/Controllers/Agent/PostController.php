<?php

namespace App\Http\Controllers\Admin;

use App\Actions\File\File;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.post.index',compact('posts'));
    }

    public function getAllData()
    {
        return Post::latest()->get();
    }
    function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required'],
            'category_id' => ['required'],
            'sub_category_id' => ['required'],
            'description' => ['required'],
            'image' => ['required','mimes:jpg,png,jpeg']
        ]);
        $category =  Post::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'author_id' => auth()->id(),
            'sub_category_id' => $request->sub_category_id,
            'description' => $request->description,
            'image' => File::upload($request->file('image'), 'post')
        ]);
        if ($category) {
            return redirect()->route('admin.post.index');
        }
    }

    public function show(Post $post)
    {
        $post->load(['category','author','sub_category']);
        return view('backend.post.show',compact('post'));

    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.post.create',compact('categories'));
    }
    public function getSubCat($category)
    {
     return Category::with('children')->find($category);
    }
    public function edit(Post $post)
    {
        $post->load(['category','author','sub_category']);
        $categories = Category::get();
        $sub_categories = SubCategory::get();
        return view('backend.post.edit',compact('post','categories','sub_categories'));
    }

    public function destroy(Post $post)
    {
        $image = $post->image;
        File::deleteFile($image);
         $post->delete();
         return back();
    }
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'name' => "required|unique:categories,name,{$post->id}",
        ]);

        if ($request->file('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ]);
            $olgImage = $post->image;
            $post =   $post->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'author_id' => auth()->id(),
                'sub_category_id' => $request->sub_cat_id,
                'image' => File::upload($request->file('image'), 'post')
            ]);
            File::deleteFile($olgImage);
        } else {
            $post =  $post->update([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'author_id' => auth()->id(),
                'sub_category_id' => $request->sub_cat_id,    
            ]);
        }

        if ($post) {
            return redirect()->route('admin.post.index');
        } else {
            return false;
        }
    }
}
