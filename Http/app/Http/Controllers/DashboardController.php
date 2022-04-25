<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public $api = "http://127.0.0.1:8000/api/v1/";
    public function index()
    {
        $url = $this->api . "products";
        $response =  Http::get($url);
        $jsonResponse = json_decode($response->body());

        $products =  $jsonResponse->data;
        return view('home', compact('products'));
    }

    public function store(Request $request)
    {
        $url = $this->api . "products";
        try {
            $response =  Http::post($url, [
                'name' => $request->name
            ]);

            return redirect('/home');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    protected function checkAuthUser()
    {
        return session()->has('authToken') ? true : false;
    }
}
