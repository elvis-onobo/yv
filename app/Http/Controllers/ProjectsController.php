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
        
    }
}
