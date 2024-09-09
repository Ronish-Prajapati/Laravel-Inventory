@extends('layouts.app')

@section('content')
    
@if($orders->isEmpty())
    <p>You have no orders yet.</p>
@else
<div class="container">
    <h1>Manage Orders</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                <th>Customer</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                     <td>{{ $order->product->name }}</td>
                    <td>{{ $order->user->name }}</td> 
                    <td>{{ $order->status }}</td>
                    <td>
                        <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST">
                            @csrf
                            <select name="status">
                                <option value="Pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="Cancel" {{ $order->status == 'cancel' ? 'selected' : '' }}>Cancel</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
@endsection
