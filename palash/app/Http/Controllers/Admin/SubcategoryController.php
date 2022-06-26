<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.sub_category.index',compact('categories'));
    }

    public function getAllData()
    {
        return SubCategory::with('category')->latest()->get();
    }

    function store(Request $request)
    {
        $category =  SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
        if ($category) {
            return true;
        }
    }

    public function show(SubCategory $category)
    {
        return $category->load('category');
    }

    public function edit(SubCategory $category)
    {
        return $category;
    }

    public function destroy(SubCategory $category)
    {
        $image = $category->image;

        return $category->delete();
    }
    public function update(Request $request, SubCategory $category)
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
             
            ]);
  
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
