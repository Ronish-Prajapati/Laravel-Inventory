<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Unit;

use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Auth;
class OrderController extends Controller
{
    public function adminIndex()
    {

        $orders = Order::with('product', 'user')->get();
         // Fetch orders with related products and customers
        return view('admin.orders.index', compact('orders')); // Pass orders to the view


    }
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $orders = Order::where('user_id', $user->id)->get(); // Query by user_id
        return view('Orders.index', compact('orders')); // Return the view with the orders data
    }

    public function create()
    {
        $products = Product::where('stock_quantity', '>', 0)->get();

        return view('Orders.create', compact('products'));

    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $customer = Auth::user()->customer;


        $request->validate([
            "product_id" => "required|exists:products,id",
            "quantity" => "required|integer|min:1",
        ]);

        $product = Product::findOrFail($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        $order = Order::create([
            'user_id' => $user->id,
            'customer_id' => $user->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);


        return redirect()->route('orders.index')->with('success', 'Order created successfully.');
        // return view('order.create')->with(['model'=>$order]);

    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        // Check if the status is being changed to "completed"
        if ($request->status == 'Completed' && $order->status != 'Completed') {
            $product = $order->product;

            // Ensure that the product has enough stock to fulfill the order
            if ($product->stock_quantity >= $order->quantity) {
                // Decrease the product's stock quantity
                $product->stock_quantity -= $order->quantity;
                $product->save();
            } else {
                return redirect()->back()->with('error', 'Not enough stock to complete this order.');
            }
        }

        // Update the order status
        $order->status = $request->status;
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully.');
    }

}
