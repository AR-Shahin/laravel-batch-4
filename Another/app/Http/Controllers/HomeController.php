<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public $api = "http://127.0.0.1:8000/api/v1/";
    public function index()
    {
        if (!$this->checkAuth()) {
            return redirect('login');
        }
        // return $this->authToken();
        $url = $this->api . "products";
        $response = Http::withToken($this->authToken())->get($url);
        $jsonData = json_decode($response->body());
        // dd($jsonData);
        $products = $jsonData->data;
        return view('home', compact('products'));
    }

    public function login()
    {
        if ($this->checkAuth()) {
            return redirect('home');
        }
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function handleLogin(Request $request)
    {
        $url = $this->api . "login";

        $response = Http::post($url, [
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $jsonResponse = json_decode($response->body());
        session()->put('authToken', $jsonResponse->access_token);

        return redirect('/home');
    }

    public function handleRegister(Request $request)
    {
        $url = $this->api . "register";

        $response = Http::post($url, [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);


        return redirect('/login');
    }

    protected function authToken()
    {
        return session('authToken');
    }

    function logout()
    {
        $url = $this->api . "logout";

        $response = Http::withToken($this->authToken())->post($url);
        session()->forget('authToken');

        return redirect('/login');
    }

    protected function checkAuth(): bool
    {
        return $this->authToken() ? true : false;
    }
}
