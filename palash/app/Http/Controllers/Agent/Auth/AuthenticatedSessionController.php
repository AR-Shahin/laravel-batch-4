<?php

namespace App\Http\Controllers\Agent\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AgentAuthRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\SellerLoginRequest;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('agent.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AgentAuthRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('agent.dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('agent')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('agent.login');
    }
}
