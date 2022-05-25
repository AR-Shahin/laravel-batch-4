<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PolicyController extends Controller
{
    public function index()
    {
        $products = Product::with('user')->get();
        return view('policy', compact('products'));
    }

    function show(Product $product)
    {
        $this->authorize('view', $product);
        return $product;
    }
}
