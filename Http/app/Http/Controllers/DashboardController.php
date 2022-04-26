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
        // return $this->authToken();
        if (!$this->checkAuthUser()) {
            return redirect('login');
        }
        $url = $this->api . "products";
        $response =  Http::withToken($this->authToken())->get($url);
        // dd($response->json());
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
    public function viewLogin()
    {
        if ($this->checkAuthUser()) {
            return redirect('home');
        }
        return view('login');
    }
    public function handleLogin(Request $request)
    {
        $url = $this->api . "login";
        try {
            $response = Http::post($url, [
                'email' => $request->email,
                'password' => $request->password,
            ]);

            $jsonResponse = json_decode($response->body());
            // dd($jsonResponse);
            session()->put('authToken', $jsonResponse->access_token);
            return redirect('home');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function handleRegister(Request $request)
    {
        //  return $request;
        $url = $this->api . "register";
        try {
            $user = Http::post($url, [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
            ]);

            return redirect('login');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function logout(Request $request)
    {
        $url = $this->api . "logout";
        try {
            $user = Http::withToken($this->authToken())->post($url);
            session()->forget('authToken');
            return redirect('login');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    private function authToken()
    {
        return session('authToken');
    }
}
