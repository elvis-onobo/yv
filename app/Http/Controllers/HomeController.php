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
        $cats = DB::table('categories')->get();

        return view('home', compact('users', 'accounts', 'kins', 'projects', 'cats'));
    }

    /**
     * show details of the project
     */
    public function details($id){
        $projects = DB::table('projects')->where('id', $id)->get();
        $cats = DB::table('categories')->get();

        return view('user.details', compact('projects', 'cats'));
    }

    /**
     * show the purchase form
     */
    public function purchase($id){
        $projects = DB::table('projects')->where('id', $id)->get();
        $cats = DB::table('categories')->get();

        return view('user.purchase', compact('projects', 'cats'));
    }

    /**
     * get the projects belonging to a user
     */
    public function myProjects(){
        $projects = DB::table('projects')->where('id', auth()->user()->id)->get();
        $cats = DB::table('categories')->get();

        return view('user.my-projects', compact('projects', 'cats'));        
    }

    public function withdraw(){
        $projects = DB::table('projects')->where('id', $id)->get();
        $cats = DB::table('categories')->get();

        return view('user.withdraw', compact('projects', 'cats'));
    }

    public function pay(Request $request, $id){
        $request->validate([
            'slots' => 'required'
        ]);
        $user = User::where('id', auth()->user()->id)->first();
        $cats = DB::table('categories')->get();
        $projects = DB::table('projects')->where('id', $id)->first();
        $slots =  $request->slots;

        return view('user.pay', compact('projects', 'cats', 'slots', 'user'));
    }

    /**
     * verifies if a payment was successful
     */
    public function verify_payment(){
        //set the headers and method
        $opt = [
            "http" => [
                'method' => 'GET',
                'header' => 'Authorization: Bearer sk_test_03396cc3b78b097e34327027910859c1a5a8f973',
            ]
        ];

        $con = stream_context_create($opt);

        $data = file_get_contents('https://api.paystack.co/transaction/verify/T663603495807161', false, $con);


        if($data){
            //convert data to json
            $json_data = json_decode($data, true);
            //check if data is json
            if($json_data){
                //check if status is successful
                if($json_data['data']['status'] === 'success'){
                    return 'tranx verified';
                }
            }
        }

    }
}
