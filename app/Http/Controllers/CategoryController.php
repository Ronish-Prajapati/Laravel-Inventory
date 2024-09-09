<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("categories.index")->with('model',$categories);
    }
    public function create()
    {
        
        return view('categories.create')
        ->with(['model'=>new Category()]);
    }
    public function store(Request $request){
        $attributes=$request->validate([
            'name'=>'required',
            'description'=>'nullable'
        ]);
    $category = new Category();
    $category->name = $attributes['name'];
    $category->description = $attributes['description'];
    $category->save();

    }
    
    public function destroy($id){
       
        $category = Category::findOrFail($id);
        $category->delete();
    
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.'); 
        
    }

}
