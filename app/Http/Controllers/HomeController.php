<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Account;
use App\Profile;
use App\User;
use App\Kin;
use Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = DB::table('users')
                    ->join('profiles', 'users.id', 'profiles.user_id')
                    ->join('accounts', 'users.id', 'accounts.user_id')
                    // ->join('kins', 'users.id', 'kins.user_id')
                    ->select('users.*', 'profiles.phone', 'profiles.dob',
                            'profiles.address', 'profiles.nationality',
                            'profiles.gender', 'profiles.picture',
                            'accounts.username', 'accounts.acc_number',
                           'accounts.bank' 
                           //'kins.name', 'kins.relationship',
                        // 'kins.email', 'kins.phone', 'kins.address'
                        )
                    ->where('users.id', auth()->user()->id)
                    ->get();
                    
        return view('home', compact('users'));
    }
}
