@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Orders</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($orders->isEmpty())
        <p>You have no orders yet.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->product->name }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->total_price }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->created_at->format('d M Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection