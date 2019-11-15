<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    public function create(){
        return view('admin.category.category');
    }

    public function store(Request $request){
        $data = $request->validate([
            'category' => 'required'
        ]);

        $cat = new Category;
        $cat->created_by = auth()->user()->id;
        $cat->category = $request->category;

        if($cat->save()){
            return back()->with('status', 'Category created!');
        }
        return back()->with('status', 'Problem encountered, Category not created!');

    }

    public function edit(){
        return view('admin.category.edit-category');
    }

    public function update($id){
        $data = $request->validate([
            'category' => 'required'
        ]);

        $cat = [
                'category' => $request->category
            ];

        if(DB::table('categories')->update($cat)){
            return back()->with('status', 'category updated');
        }
        return back()->with('status', 'category not updated');

    }
}
