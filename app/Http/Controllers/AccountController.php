<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\User;
use Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $account = Account::find(auth()->user()->id)->first();

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
            'username' => 'required|nullable',
            'acc_number' => 'required|nullable|digits:10',
            'bank' => 'required|nullable'
        ]);

        $values = [
            'username' => $request->username,
            'acc_number' => $request->acc_number,
            'bank' => $request->bank
        ];

        // save the data and redirect accordingly
        if(Account::updateOrInsert(
            ['user_id'=>auth()->user()->id],
            $values
            )){
            return redirect('/home')->with('status', 'Account updated!');
        }else{
            return redirect('/account')->with('status','Please check and refill correctly');
        }
    }

}
