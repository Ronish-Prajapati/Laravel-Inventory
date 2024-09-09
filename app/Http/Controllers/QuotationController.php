<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

use Auth;
class QuotationController extends Controller
{
    public function index()
    {
        // Retrieve all quotations, you may want to paginate or filter these in practice
        $quotations = Quotation::with('product', 'supplier')->get();
        return view('quotations.index', compact('quotations'));
    }

    // Show the form for creating a new quotation
  
        public function create()
        {
            $supplier = auth()->user()->supplier;

            // Check if the supplier is valid and not null
            if ($supplier) {
                // Fetch products associated with the supplier from the pivot table
                $products = $supplier->products()->get();
            } else {
                // If supplier is not valid, set products to an empty collection
                $products = collect();
            }
        
            return view('quotations.create', compact('products'));
        }
        

    // Store a newly created quotation in storage
    public function store(Request $request)
    {
        $user = Auth::user();
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric',
            'valid_until' => 'required|date'
        ]);
    
        // Retrieve the authenticated supplier
        $supplier = auth()->user()->supplier;
    
        // Fetch the product associated with the supplier by ID
        $product = $supplier->products()->where('id', $request->product_id)->first();
    
        // Check if the product exists and the stock quantity is sufficient
        if ($product && $product->pivot->stock_quantity >= $request->quantity) {
            // Create the quotation with user_id included
            Quotation::create([
 // Ensure user_id is included
                'supplier_id' => $supplier->user_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price_per_unit' => $request->price_per_unit,
                'valid_until' => $request->valid_until,
                'status' => 'pending',
            ]);
    
            // Redirect or do something after successful creation
            return redirect()->route('quotations.index')->with('success', 'Quotation created successfully.');
        } else {
            // Handle the case where the product does not exist or stock is insufficient
            return back()->withErrors(['error' => 'Product not found or insufficient stock.']);
        }
    }
    

    // Show the form for editing the specified quotation
    public function edit($id)
    {
        $quotation = Quotation::findOrFail($id);
        return view('quotations.edit', compact('quotation'));
    }

    // Update the specified quotation in storage
    public function update(Request $request, $id)
    {
        $quotation = Quotation::findOrFail($id);
        // Validate request if needed
        $quotation->update($request->all());
        return redirect()->route('quotations.index')->with('success', 'Quotation updated successfully.');
    }

    // Approve the specified quotation and update stock quantities
    public function approve($id)
    {
        $quotation = Quotation::findOrFail($id);

        // Check if there's enough stock on the supplier's side
        $supplierProduct = $quotation->supplier->products()->where('product_id', $quotation->product_id)->first();

        if ($supplierProduct && $supplierProduct->pivot->stock_quantity >= $quotation->quantity) {
            // Decrease the supplier's stock
            $supplierProduct->pivot->stock_quantity -= $quotation->quantity;
            $supplierProduct->pivot->save();

            // Check if the product exists in the admin's product table by name
            $product = Product::where('name', $supplierProduct->name)->first();

            if ($product) {
                // If product exists, increase its quantity
                $product->quantity += $quotation->quantity;
            } else {
                // If product doesn't exist, create a new product entry
                $product = Product::create([
                    'name' => $supplierProduct->name,
                    'stock_quantity' => $quotation->quantity,
                    'price' => $supplierProduct->price*$quotation->quantity, // Adjust as necessary
                ]);
            }

            $product->save();

            // Update the quotation status to 'approved'
            $quotation->status = 'approved';
            $quotation->save();

            return redirect()->route('quotations.index')->with('success', 'Quotation approved successfully.');
        } else {
            return redirect()->back()->with('error', 'Not enough stock to approve this quotation.');
        }
    }

    // Remove the specified quotation from storage
    public function destroy($id)
    {
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();
        return redirect()->route('quotations.index')->with('success', 'Quotation deleted successfully.');
    }

}
