<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function create()
    {
        return view('backend.admin.create');
    }

    public function index()
    {
        $admins = Admin::where('id','!=',auth()->id())->get();
        return view('backend.admin.index',compact('admins'));
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            "email" => ['unique:admins,email']
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);
        if($admin){
            return view('backend.admin.index');
        }
    }
    public function delete(Admin $admin)
    {
        $admin->delete();
        return view('backend.admin.index');
    }
}
