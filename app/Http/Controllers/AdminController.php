<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Auth;

class AdminController extends Controller
{
    /**
     * show home view
     */
    public function home(){
        $projects = Project::all()->paginate(6);
        return view('admin.home', compact('projects'));
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


}
