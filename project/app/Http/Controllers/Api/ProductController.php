<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
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


    public function view($id)
    {
        try {
            $product = Product::whereId($id)->first();

            if ($product) {
                return sendSuccessResponse($product, 'Data retrieve Successfully!', 200);
            } else {
                return sendSuccessResponse([], 'Data not available!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something went wrong!", $e->getMessage(), 500);
        }
    }

    public function delete($id)
    {
        try {
            $product = Product::whereId($id)->first();

            if ($product) {
                $product->delete();
                return sendSuccessResponse([], 'Data Deleted Successfully!', 200);
            } else {
                return sendSuccessResponse([], 'Data not available!', 404);
            }
        } catch (QueryException $e) {
            return sendErrorResponse("Something went wrong!", $e->getMessage(), 500);
        }
    }
}
