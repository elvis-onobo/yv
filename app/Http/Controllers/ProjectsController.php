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
    public function project(){
        @$project = Project::get();
        return view('admin.projects', compact('project'));
    }

    /**
     * insert new project to db or update if exists
     */
    public function create_projects(Request $request){
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

        $values = [
            'created_by' => auth()->user()->id,
            'project_picture' => $request->picture != null ? $request->file('picture')->store('pictures', 'public') : Project::find(auth()->user()->id)->project_picture ,
            'title' => $request->title,
            'returns' => $request->returns,
            'duration' => $request->duration,
            'location' => $request->location,
            'minimum_investment' => $request->minimum,
            'risk' => $request->risk
        ];

        // save the data and redirect accordingly
        if(Project::updateOrInsert(
            ['created_by' => auth()->user()->id],
            $values
        )){
            return redirect('/admin/home')->with('status', 'Project Published!');
        }else{
            return back()->with('status','There is an error, please verify');
        }                
    }
}
