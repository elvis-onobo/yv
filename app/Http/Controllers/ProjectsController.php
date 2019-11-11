<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Auth\User;
use Auth;

class ProjectsController extends Controller
{
    /**
     * show the project creation form
     */
    public function project(){
        return view('admin.project');
    }

    public function create_projects(Request $request){
        $data = $request->validate([
            'phone' => 'nullable|digits:11',
            'dob' => 'nullable|date',
            'gender' => ['nullable', Rule::in(['male','female'])],
            'picture' => 'nullable'
        ]);

        if($request->picture != null){
            // delete the previous picture and store new one
            $pixToDelete = Profile::find(auth()->user()->id)->picture;
            Storage::disk('public')->delete($pixToDelete);
            $request->file('picture')->store('projects', 'public');
        }

        $values = [
            'phone' => $request->phone,
            'dob' => $request->dob,
            'address' => $request->address,
            'nationality' => $request->nationality,
            'gender' => $request->gender,
            'picture' => $request->picture != null ? $request->file('picture')->store('pictures', 'public') : Profile::find(auth()->user()->id)->picture 
        ];

        // save the data and redirect accordingly
        if(Profile::updateOrInsert(
            ['user_id' => auth()->user()->id],
            $values
        )){
            return redirect('/home')->with('status', 'Profile updated!');
        }else{
            return redirect('/profile')->with('status','There is an error, please check and correct it');
        }                
    }
}
