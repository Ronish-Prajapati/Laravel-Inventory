@extends('layouts.app')


@section('content')

<table class="table">
    <thead>
        <tr>
            <th>product</th>
            <th>category</th>
            <th>Unit</th>
            <th>Quantity</th>
        </tr>
    </thead>
    @foreach ($model as $product)
        <tr>
            <td>{{$product->name}}</td>
            <td>{{$product->category->name}}</td>
            <td>{{$product->unit->name}}</td>
            <td>{{$product->stock_quantity}}</td>
        </tr>
    @endforeach

    
</table>

@endsection

