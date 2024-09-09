@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @extends('adminlte::page')

                    @section('title', 'Dashboard')

                @section('content_header')
                <h1>Dashboard</h1>
                 @stop

                @section('content')
                <p>Welcome to this beautiful admin panel.</p>
                @stop
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
