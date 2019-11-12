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
     * show the project creation form
     */
    public function create(){
        return view('admin.projects', compact('project'));
    }

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
            'risk' => 'required'
        ]);

        if($request->picture != null){
            // delete the previous picture and store new one
            $pixToDelete = Project::find(auth()->user()->id)->project_picture;
            Storage::disk('public')->delete($pixToDelete);
            $request->file('picture')->store('projects', 'public');
        }

        $project = new Project;
        $project->created_by = auth()->user()->id;
        $project->project_picture = $request->picture != null ? $request->file('picture')->store('pictures', 'public') : Project::find(auth()->user()->id)->project_picture;
        $project->title = $request->title;
        $project->returns = $request->returns;
        $project->duration = $request->duration;
        $project->location = $request->location;
        $project->minimum_investment = $request->minimum;
        $project->risk = $request->risk;

        // save the data and redirect accordingly
        if($project->save()){
            return redirect('/admin/home')->with('status', 'Project Published!');
        }else{
            return back()->with('status','There is an error, please verify');
        }                
    }
}
