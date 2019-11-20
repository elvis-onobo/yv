<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Account;
use App\User;
use Auth;

class AccountController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //get the list of banks and pass it
        $opt = [
            "http" => [
                'method' => 'GET',
                'header' => 'Authorization: Bearer sk_test_03396cc3b78b097e34327027910859c1a5a8f973',
            ]
        ];

        $con = stream_context_create($opt);

        $datas = file_get_contents('https://api.paystack.co/bank', false, $con);
        
        $data = json_decode($datas, true);

        $cats = DB::table('categories')->get();

        return view('user.account', compact('cats', 'data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Account::where('user_id', auth()->user()->id)->exists()){
            $data = $request->validate([
                'username' => 'nullable',
                'acc_number' => 'nullable|digits:10',
                'bank' => 'nullable'//digits:3
            ]);

            $account = new Account;
            $account->user_id = auth()->user()->id;
            $account->username = $request->username;
            $account->acc_number = $request->acc_number;
            $account->bank = $request->bank;
            // save the data and redirect accordingly
            if($account->save()){
                return redirect('/home')->with('status', 'Account updated!');
            }else{
                return redirect('/account')->with('status','Please check and refill correctly');
            }
        }else{
            return back()->with('status', 'You already have an account, edit it instead.');
        }
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $opt = [
            "http" => [
                'method' => 'GET',
                'header' => 'Authorization: Bearer sk_test_03396cc3b78b097e34327027910859c1a5a8f973',
            ]
        ];

        $con = stream_context_create($opt);

        $datas = file_get_contents('https://api.paystack.co/bank', false, $con);
        
        $data = json_decode($datas, true);

        $account = Account::find(auth()->user()->id)->first();
        $cats = DB::table('categories')->get();

        return view('user.account', compact('account', 'cats', 'data'));
    }

    /**
     * update account
     */
    public function update(Request $request, $id){
        $data = $request->validate([
            'username' => 'nullable',
            'acc_number' => 'nullable|digits:10',
            'bank' => 'nullable'//digits:3
        ]);

        $values = [
            'username' => $request->username,
            'acc_number' => $request->acc_number,
            'bank' => $request->bank
        ];

        // save the data and redirect accordingly
        if(DB::table('accounts')->where('user_id', auth()->user()->id)->update()){
            return redirect('/home')->with('status', 'Account updated!');
        }else{
            return redirect('/account')->with('status','Please check and refill correctly');
        }
    }
}
