@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create Quotation</h1>

    <!-- Display validation errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Quotation Form -->
    <form action="{{ route('quotations.store') }}" method="POST">
        @csrf

        <!-- Product Selection -->
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="" selected disabled>Select a product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->pivot->stock_quantity }})</option>
                @endforeach
            </select>
        </div>

        <!-- Quantity Input -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="price_per_unit" class="form-label">Price Per Unit</label>
            <input type="number" name="price_per_unit" id="price_per_unit" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="valid_until" class="form-label">Valid  Unitil</label>
            <input type="date" name="valid_until" id="valid_until" class="form-control" required>
        </div>

        

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Submit Quotation</button>
    </form>
</div>
@endsection
