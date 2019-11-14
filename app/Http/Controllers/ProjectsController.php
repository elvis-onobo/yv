<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Project;
use Auth\User;
use Auth;

class ProjectsController extends Controller
{

    /**
     * insert new project to db or update if exists
     */
    public function store(Request $request){
        $data = $request->validate([
            'project_picture' => 'nullable',
            'title' => 'required',
            'returns' => 'required',
            'duration' => 'required',
            'location' => 'required',
            'minimum' => 'required',
            'risk' => 'required',
            'partner' => 'required',
            'details' => 'required'
        ]);

        $project = new Project;
        $project->created_by = auth()->user()->id;
        $project->project_picture =  $request->file('picture')->store('projects', 'public');
        $project->title = $request->title;
        $project->returns = $request->returns;
        $project->duration = $request->duration;
        $project->location = $request->location;
        $project->minimum_investment = $request->minimum;
        $project->risk = $request->risk;
        $project->partner = $request->partner;
        $project->details = $request->details;
        $project->code = bin2hex(random_bytes(6));

        // save the data and redirect accordingly
        if($project->save()){
            $request->file('picture')->store('projects', 'public');
            return redirect('/admin/home')->with('status', 'Project Published!');
        }else{
            return back()->with('status','There is an error, please verify');
        }                
    }

    public function edit(){

    }

    public function update($id){
        $data = $request->validate([
            'project_picture' => 'nullable',
            'title' => 'required',
            'returns' => 'required',
            'duration' => 'required',
            'location' => 'required',
            'minimum' => 'required',
            'risk' => 'required'
        ]);

        if($request->picture != null){
            // delete the previous picture and store new one
            $pixToDelete = $request->picture != null ? Project::find(auth()->user()->id)->picture : "";
            Storage::disk('public')->delete($pixToDelete);
            $request->file('picture')->store('projects', 'public');
        }

        $project = new Project;
        $project->created_by = auth()->user()->id;
        $project->project_picture = $request->picture != null ? $request->file('picture')->store('projects', 'public') : Project::find(auth()->user()->id)->picture;
        $project->title = $request->title;
        $project->returns = $request->returns;
        $project->duration = $request->duration;
        $project->location = $request->location;
        $project->minimum_investment = $request->minimum;
        $project->risk = $request->risk;
        $project->details = $request->details;
        
        // save the data and redirect accordingly
        if($project->save()){
            return redirect('/admin/home')->with('status', 'Project Published!');
        }else{
            return back()->with('status','There is an error, please verify');
        }                
    }
}
