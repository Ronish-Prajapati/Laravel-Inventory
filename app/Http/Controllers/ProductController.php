<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;

use Spatie\Permission\Models\Role;
use Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource 
     *
     *
     */
    public function index()
    {
        
        return view('product.index')->with('model', Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * 
     */
    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('product.create')
        ->with(['model'=>new Product(),
                'categories'=> $categories,
                'units'=>$units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'stock_quantity' => ['required'],
            'category_id'=>['required', 'exists:categories,id'],
            'unit_id'=>['required', 'exists:units,id']
        ]);
        
        Auth::user()->products()->save(new Product([
            'name' => $attributes['name'],
            'stock_quantity' => $attributes['stock_quantity'],
            'category_id'=>$attributes['category_id'],
            'unit_id'=>$attributes['unit_id'],
        ]));
        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     */
    public function edit(Product $product)
    {
        $categories=Category::all();
        $units = Unit::all();
        return view('product.edit',
        ['Product'=>$product,
        'Categories' => $categories,
        'Units' => $units,    
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name' => 'required',
            'stock_quantity' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'unit_id' => 'required|exists:units,id',
        ]);
        
        $product->fill($attributes);
        $product->category_id = $request->category_id; // Update category
        $product->unit_id = $request->unit_id; // Update unit
         $product->save();

    return redirect()->route('product.index')->with('status', 'The product has been updated');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * 
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
        
    }
}
