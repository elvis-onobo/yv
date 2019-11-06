<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Profile;
use App\User;
use Auth;

class ProfileController extends Controller
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
        $profile = Profile::find(auth()->user()->id);
        return view('user.profile', compact($profile));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Profile::where('phone', $request->phone)->doesntExist() ){
            $data = $request->validate([
                'phone' => 'sometimes|digits:11',
                'dob' => 'nullable|date',
                'gender' => ['nullable', Rule::in(['male','female'])],
                'picture' => 'nullable'
            ]);

            if($request->hasFile('picture')){
                // delete the previous picture and store new one
                $pixToDelete = Profile::find(auth()->user()->id)->picture;
                Storage::disk('public')->delete($pixToDelete);
                $request->file('picture')->store('pictures', 'public');
            }else{
                $useAvatar = 'avatar.jpg';
            }

            $values = [
                'phone' => $request->phone,
                'dob' => $request->dob,
                'address' => $request->address,
                'nationality' => $request->nationality,
                'gender' => $request->gender,
                'picture' => $request->file('picture')->store('pictures', 'public')
            ];

            // save the data and redirect accordingly
            if(Profile::updateOrInsert(
                ['user_id'=>auth()->user()->id],
                $values
                )){
                return redirect('/home')->with('status', 'Profile updated!');
            }else{
                return redirect('/profile')->with('status','There is an error, please check and correct it');
            }                
              
        }else{
            return redirect('/profile')->with('status','The phone number '.$request->phone.' has been taken');
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


}
