<?php

namespace App\Http\Controllers;

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
        return view('user.account', compact('account'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'nullable',
            'acc_number' => 'nullable|digits:10',
            'bank' => 'nullable'//digits:3
        ]);

        $account = new Account;
        $account->username = $request->username;
        $account->acc_number = $request->acc_number;
        $account->bank = $request->bank;
        // save the data and redirect accordingly
        if($account->save()){
            return redirect('/home')->with('status', 'Account updated!');
        }else{
            return redirect('/account')->with('status','Please check and refill correctly');
        }
    }

/**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $account = Account::find(auth()->user()->id)->first();

        return view('user.account', compact('account'));
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
