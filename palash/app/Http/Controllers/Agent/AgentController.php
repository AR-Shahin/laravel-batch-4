<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function create()
    {
        return view('seller.agent.create');
    }

    public function index()
    {
        $admins = Agent::where('seller_id','=',auth()->id())->get();
        return view('seller.agent.index',compact('admins'));
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => ['required'],
            "email" => ['unique:admins,email'],
            "phone" => ['required'],
            "password" => ['required'],
        ]);

        $admin = Agent::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'seller_id' => auth('seller')->id(),
            'password' => bcrypt($request->password)
        ]);
        if($admin){
            return redirect()->route('seller.agent.index');
        }
    }
    public function delete(Agent $admin)
    {
        $admin->delete();
        return redirect()->route('seller.agent.index');

    }
}
