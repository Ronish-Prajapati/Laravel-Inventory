@extends('layouts.app')

@section('content')
<div class="container">
    <h1>create new</h1>
    <form action="{{route('product.store')}}" method="POST">
        @include('product.partials.fields')
        @csrf
    </form>
</div>
@endsection
