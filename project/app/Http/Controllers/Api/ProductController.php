<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        try {
            $data = Product::latest()->get();
            return sendSuccessResponse($data, 'Data Retrieve Successfully!');
        } catch (QueryException $e) {
            return sendErrorResponse("Database connection failed!", $e->getMessage(), 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'unique:products,name']
        ]);

        if ($validator->fails()) {
            return sendErrorResponse($validator->errors(), 'Client Side Error!', 422);
        }

        try {
            $data = $validator->validate();
            $data['slug'] = str($data['name'])->slug();
            $product = Product::create($data);

            return sendSuccessResponse($product, 'Data Created Successfully!', 201);
        } catch (QueryException $e) {
            return sendErrorResponse("Something went wrong!", $e->getMessage(), 500);
        }
    }
}
