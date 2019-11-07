<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kin;
use App\User;
use Auth;

class KinController extends Controller
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
        return view('user.kin');
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
            'name' => 'required',
            'relationship' => 'required',
            'phone' => 'required|digits:11',
        ]);

        $kin = new Kin;
        $kin->user_id = auth()->user()->id;
        $kin->name_kin = $request->name;
        $kin->relationship = $request->relationship;
        $kin->email_kin = $request->email;
        $kin->phone_kin = $request->phone;
        $kin->address_kin = $request->address;

        // save the data and redirect accordingly
        if($kin->save()){
            return redirect('/home')->with('status', 'Next of updated!');
        }else{
            return redirect('/kin')->with('status','Please check and refill correctly');
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
