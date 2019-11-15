<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Category;
use Auth;

class CategoryController extends Controller
{
    /**
     * show all the categories
     */
    public function index(){
        $cats = DB::table('categories')->get();

        return view('admin.category.all-categories', compact('cats'));
    } 

    /**
     * show the create form
     */
    public function create(){
        return view('admin.category.category');
    }

    /**
     * store the category
     */
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

    /**
     * edit the category
     */
    public function edit($id){
        $cat = DB::table('categories')->where('id', $id)->first();

        return view('admin.category.edit-category', compact('cat'));
    }

    /**
     * update the category
     */
    public function update(Request $request, $id){
        $data = $request->validate([
            'category' => 'required'
        ]);

        $cat = [
                'category' => $request->category
            ];

        if(DB::table('categories')->where('id', $id)->update($cat)){
            return back()->with('status', 'category updated');
        }
        return back()->with('status', 'category not updated');

    }
}
