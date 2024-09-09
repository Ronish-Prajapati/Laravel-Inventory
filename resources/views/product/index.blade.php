@extends('layouts.app')


@section('content')

<table class="table" style="margin: 40px">
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
           
            <td>
                <a href="{{route('product.edit',['product'=>$product->id])}}">
                {{$product->name}}
                 </a>    
            </td>
            
            <td>{{$product->category->name}}</td>
            <td>{{$product->unit->name}}</td>
            <td>{{$product->stock_quantity}}</td>
            @role('Admin')
            <td> 
                <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
            @endrole
        </tr>
    @endforeach

    
</table>
@role('Admin')
<a href="{{route('product.create')}}">
    <button style="margin: 40px" class="btn-primary">create new</button>
</a>
<a href="{{route('category.create')}}">
    <button style="margin: 40px" class="btn-primary">Create Category</button>
</a> 
@endrole
@role('Customer')
<a href="{{route('orders.create')}}">
    <button style="margin: 40px" class="btn-primary">Create Order</button>
</a>
@endrole

@endsection

