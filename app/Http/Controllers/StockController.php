<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
class StockController extends Controller
{
    public function create()
    {
        $stocks = Stock::all(); // List all products
        return view('stocks.create', compact('stocks'));
    }
    public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'stock_quantity' => 'required|integer|min:1',
        'price_per_unit'=>'required'
    ]);

    $supplier = auth()->user()->supplier;

    // Check if the product is associated with the supplier
    $product = $supplier->products()->where('products.id', $request->product_id)->first();

    if ($product) {
        // Check if stock already exists for the product
        $stock = Stock::where('supplier_id', $supplier->id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($stock) {
            // Update existing stock
            $stock->stock_quantity += $request->stock_quantity;
            $stock->save();
        } else {
            // Create new stock entry
            Stock::create([
                'supplier_id' => $supplier->id,
                'product_id' => $request->product_id,
                'stock_quantity' => $request->stock_quantity,
                'price_per_unit'=>$request->stock_price_per_unit,
            ]);
        }

        return redirect()->route('stocks.index')->with('success', 'Stock updated successfully.');
    } else {
        // Handle the case where the product is not associated with the supplier
        return back()->withErrors(['error' => 'Product not associated with this supplier.']);
    }
}
}    
