<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use Auth;

class PasswordChangeController extends Controller
{
    public function password(){
        $cats = DB::table('categories')->get();

        return view('auth.passwords.update', compact('cats'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $password =['password' => Hash::make($data['password']) ];

        if(DB::table('users')->where('id', auth()->user()->id)->update($password)){
            return redirect('/home')->with('status', 'Password changed!');
        }else{
            back()->with('status', 'Password must be at least 8 characters long');
        }
    }
}
