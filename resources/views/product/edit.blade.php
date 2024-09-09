@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit </h1>
        <form action="{{ route('product.update', ['product' => $Product->id]) }}"
            method="POST">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">Product</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="{{ old('name', $Product->name) }}">
            </div>

            <div class="form-group">
                <label for="stock_quantity">Quantity</label>
                <input type="number" class="form-control" id="stock_quantity" name="stock_quantity"
                    value="{{ old('stock_quantity', $Product->stock_quantity) }}">
            </div>
            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach ($Categories as $category)
                        <option value="{{ $category->id }}" {{ $Product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <div class="form-group">
                <label for="unit_id">Unit</label>
                <select name="unit_id" id="unit_id" class="form-control">
                    @foreach ($Units as $unit)
                        <option value="{{ $unit->id }}" {{ $Product->unit_id == $unit->id ? 'selected' : '' }}>
                            {{ $unit->abbreviation }}
                        </option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <input type="submit" class="btn btn-default" value="submit">
            </div>
        </form>
    </div>
@endsection
