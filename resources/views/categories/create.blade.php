@extends('layouts.app')

@section('content')
<div class="container">
    <h1>create new</h1>
    <form action="{{route('category.store')}}" method="POST">
        @include('categories.partials.fields')
        @csrf
    </form>
</div>
@endsection