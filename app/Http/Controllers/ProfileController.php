<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
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
        $profile = Profile::where('user_id', auth()->user()->id)->first();

        return view('user.profile', compact('profile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!Profile::where('user_id', auth()->user()->id)->exists()){
            $data = $request->validate([
                'phone' => 'nullable|digits:11',
                'dob' => 'nullable|date',
                'gender' => ['nullable', Rule::in(['male','female'])],
                'picture' => 'nullable'
            ]);

            $profile = new Profile;
            $profile->user_id = auth()->user()->id;
            $profile->phone = $request->phone;
            $profile->dob = $request->dob; 
            $profile->address = $request->address;
            $profile->nationality = $request->nationality;
            $profile->gender = $request->gender;
            $profile->picture = $request->file('picture')->store('pictures', 'public');  


            // save the data and redirect accordingly
            if($profile->save()){
                $request->file('picture')->store('pictures', 'public');
                return redirect('/home')->with('status', 'Profile updated!');
            }else{
                return redirect('/profile')->with('status','There is an error, please check and correct it');
            }                
        }else{
            return back()->with('status', 'You have a profile already, edit it instead');
        }
    }

    /**
     * show profile edit form
     */
    public function edit($id)
    {
        $profile = Profile::where('id', $id);

        return view('user.edit-profile', compact('profile'));
    }

    /**
     * update the profile
     */
    public function update()
    {
        $data = $request->validate([
            'phone' => 'nullable|digits:11',
            'dob' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male','female'])],
            'picture' => 'nullable'
        ]);

        $profile = new Profile;
        $profile->user_id = auth()->user()->id;
        $profile->phone = $request->phone;
        $profile->dob = $request->dob; 
        $profile->address = $request->address;
        $profile->nationality = $request->nationality;
        $profile->gender = $request->gender;
        $profile->picture = $request->picture != null ? $request->file('picture')->store('pictures', 'public') : Profile::find(auth()->user()->id)->picture ;  


        if($request->picture != null){
            // delete the previous picture and store new one
            $pixToDelete = Profile::find(auth()->user()->id)->picture;
            Storage::disk('public')->delete($pixToDelete);
            $request->file('picture')->store('pictures', 'public');
        }

        // save the data and redirect accordingly
        if($profile->update()->where('id', $id)){
            return redirect('/home')->with('status', 'Profile updated!');
        }else{
            return redirect('/profile')->with('status','There is an error, please check and correct it');
        }                
    }

}
