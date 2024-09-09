@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add Product Stock</h2>
    <form action="{{ route('stocks.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" id="product_id" class="form-control" required>
                <option value="" disabled selected>Select a Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="stock_quantity">Stock Quantity</label>
            <input type="number" name="stock_quantity" id="stock_quantity" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Add Stock</button>
    </form>
</div>
@endsection