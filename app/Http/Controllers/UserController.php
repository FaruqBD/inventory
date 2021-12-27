<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if(Auth::user()->role_id ==1){
            $users = User::latest()->get();
            return view('pages.all_users', compact('users'));
        }else{
             return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        if($request->user_id === null){
            User::updateOrCreate(
                ['id' => $request->user_id],
                ['name' => $request->name,        
                'email' => $request->email,        
                'password' => Hash::make($request->password),        
                'role_id' => $request->role_id]
            );    

        }else{
            $user = User::findOrFail($request->user_id);
            $user->update($request->except('password','email','name'));

        }
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->update($request->except('password','email','name'));
        return redirect()->back();
    }


    public function edit($id)
    {
        $user = User::find($id);
        return response()->json($user);
    }

    public function destroy($id)
    {
        User::find($id)->delete();

        return redirect()->back();
    }
}
