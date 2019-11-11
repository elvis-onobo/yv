<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AdminController extends Controller
{
    /**
     * show home view
     */
    public function home(){
        return view('admin.home');
    }

    /**
     * show admin login form
     * 
     */
    public function adminLogin()
    {
        return view('admin.admin-login');
    }

    /**
     * logs in the user
     */
    public function loginTheAdmin(Request $request){
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(Auth::guard('admin')->attempt([
            'email' => $data['email'] ,
            'password' => $data['password']
        ], $request->get('remember'))){

                return redirect()->intended('home');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * show the project creation form
     */
    public function project(){
        return view('admin.project');
    }

    public function create_projects(Request $request){

    }
}
