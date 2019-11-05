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
        return view('user.account');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Account::where('acc_number', $request->acc_number)->doesntExist()){
            $data = $request->validate([
                'name' => 'required',
                'acc_number' => 'required|digits:10',
                'bank' => 'required'
            ]);

            $values = [
                'name' => $request->name,
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
        }else{
            return redirect('/account')->with('status','The account number '.$request->acc_number.' has been taken');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
