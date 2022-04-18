<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function login($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $tempUser = Admin::whereEmail($user->email)->first();

        if (!$tempUser) {
            $newUser = Admin::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => bcrypt(12345),
            ]);

            Auth::guard('admin')->login($newUser);
            return redirect()->route('admin.dashboard');
        } else {
            Auth::guard('admin')->login($tempUser);
            return redirect()->route('admin.dashboard');
        }
    }
}
