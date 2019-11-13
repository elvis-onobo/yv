<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Kin;
use Auth;

class KinController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('user.kin', compact('kin'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!Kin::where('user_id', auth()->user()->id)->exists()){

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

            // update the data and redirect accordingly
            if($kin->save()){
                return redirect('/home')->with('status', 'Next of updated!');
            }else{
                return redirect('/kin')->with('status','Please check and refill correctly');
            }
        }else{
            return back()->with('status', 'You have a kin already, edit instead.');
        }
    
    }

    /**
     * Show the form for editing
     *
     */
    public function edit()
    {
        $kin = Kin::find(auth()->user()->id)->first();

        return view('user.edit-kin', compact('kin'));
    }

    public function update(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'relationship' => 'required',
            'phone' => 'required|digits:11'
        ]);

        $values = [
            'name_kin' => $request->name,
            'relationship' => $request->relationship,
            'email_kin' => $request->email,
            'phone_kin' => $request->phone,
            'address_kin' => $request->address 
        ];

        // update the data and redirect accordingly
        if(DB::table('kins')->where('user_id', auth()->user()->id)->update($values)){
            return redirect('/home')->with('status', 'Next of updated!');
        }else{
            return redirect('/kin')->with('status','Please check and refill correctly');
        }
    }
}
