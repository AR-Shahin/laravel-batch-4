<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;

use App\Actions\File\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index');
    }

    public function getAllData()
    {
        return Category::latest()->get();
    }
    function store(CategoryRequest $request)
    {
        $category =  category::create([
            'name' => $request->name,
            'slug' => $request->name,
            'image' => File::upload($request->file('image'), 'category')
        ]);
        if ($category) {
            return true;
        }
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function edit(Category $category)
    {
        return $category;
    }

    public function destroy(Category $category)
    {
        $image = $category->image;
        File::deleteFile($image);
        return $category->delete();
    }
    public function update(Request $request, Category $category)
    {

        $request->validate([
            'name' => "required|unique:categories,name,{$category->id}",
        ]);

        if ($request->file('image')) {
            $request->validate([
                'image' => ['required', 'image', 'mimes:png,jpg,jpeg']
            ]);
            $olgImage = $category->image;
            $category =   $category->update([
                'name' => $request->name,
                'slug' => $request->name,
                'image' => File::upload($request->file('image'), 'category')
            ]);
            File::deleteFile($olgImage);
        } else {
            $category =   $category->update([
                'name' => $request->name,
                'slug' => $request->name
            ]);
        }

        if ($category) {
            return true;
        } else {
            return false;
        }
    }
}
