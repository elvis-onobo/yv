<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Transaction;
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
        $tranx = DB::table('transactions')->where('user_id', auth()->user()->id)->first();

        return view('home', compact('users', 'accounts', 'kins', 'projects', 'cats', 'tranx'));
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
    public function verify_payment($reference){
        //set the headers and method
        $opt = [
            "http" => [
                'method' => 'GET',
                'header' => 'Authorization: Bearer sk_test_03396cc3b78b097e34327027910859c1a5a8f973',
            ]
        ];

        $con = stream_context_create($opt);

        $data = file_get_contents('https://api.paystack.co/transaction/verify/'.$reference, false, $con);


        if($data){
            //convert data to json
            $json_data = json_decode($data, true);
            //check if data is json
            if($json_data){
                //check if status is successful
                if($json_data['data']['status'] === 'success'){
                    //insert metadata to transactions table
                    
                    $tranx = new Transaction;
                    $tranx->user_id = $json_data['data']['metadata']['user'];
                    $tranx->project_id = $json_data['data']['metadata']['project'];
                    $tranx->tranx_type = $json_data['data']['metadata']['tranx'];
                    $tranx->amount_invested = $json_data['data']['metadata']['amount']/100;
                    $tranx->slots = $json_data['data']['metadata']['slot'];
                    $tranx->duration = $json_data['data']['metadata']['duration'];
                    $tranx->roi = $json_data['data']['metadata']['roi'];
                    $tranx->project_code = $json_data['data']['metadata']['code'];

                    if($tranx->save()){
                        return redirect('/home')->with('status', 'Your transaction was successful');
                    }else{
                        return redirect('/home')->with('status', 'Your transaction did not finish processing, please contact admin');
                    }

                }else{
                    return back()->with('status', 'Sorry, Your the paymeent was not successful');
                }
            }else{
                return back()->with('status', 'Data could not be converted to JSON. Please report to admin');
            }
        }else{
            return back()->with('status', 'You are not authorized to make this transaction');
        }
    }
}
