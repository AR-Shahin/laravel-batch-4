<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('backend.dashboard');
    }

    public function seller()
    {
        $sellers = Seller::with('agents')->get();
        return view('backend.seller',compact('sellers'));
    }

    function sellerWithAgents(Seller $seller){
        $seller = $seller->load('agents');
        return view('backend.agents',compact('seller'));

    }

    public function delete(Seller $seller)
    {
        $seller->delete();

        return back();
    }
}
