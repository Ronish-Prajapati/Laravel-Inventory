@extends('layouts.app')


@section('content')

<table class="table" style="margin: 40px">
    <thead>
        <tr>
            <th>category</th>
        </tr>
    </thead>
    @foreach ($model as $category)
        <tr>
           
            <td>
                <a href="{{route('categories.edit',['category'=>$category->id])}}">
                {{$category->name}}
                 </a>    
            </td>
        </tr>
    @endforeach
</table>
@endsection