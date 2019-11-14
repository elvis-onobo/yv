<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Account;
use App\Project;
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
                    ->select('users.*', 'profiles.phone', 'profiles.dob',
                            'profiles.address', 'profiles.nationality',
                            'profiles.gender', 'profiles.picture')
                    ->where('users.id', auth()->user()->id)
                    ->get();
        $accounts = DB::table('accounts')->where('user_id', auth()->user()->id)->get();
        $kins = DB::table('kins')->where('user_id', auth()->user()->id)->get();
        $projects = DB::table('projects')->paginate(6);

        return view('home', compact('users', 'accounts', 'kins', 'projects'));
    }

    /**
     * show details of the project
     */
    public function details($id){
        $projects = DB::table('projects')->where('id', $id)->get();

        return view('user.details', compact('projects'));
    }

    /**
     * show the purchase form
     */
    public function purchase($id){
        $projects = DB::table('projects')->where('id', $id)->get();

        return view('user.purchase', compact('projects'));
    }

    /**
     * get the projects belonging to a user
     */
    public function myProjects(){
        $projects = DB::table('projects')->where('id', auth()->user()->id)->get();

        return view('user.my-projects', compact('projects'));        
    }

    public function withdraw(){
        $projects = DB::table('projects')->where('id', $id)->get();

        return view('user.withdraw', compact('projects'));
    }
}
