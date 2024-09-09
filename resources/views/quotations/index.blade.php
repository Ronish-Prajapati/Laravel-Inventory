@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Quotations</h1>

    <!-- Success or Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Quotations Table -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Supplier Name</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price Per Unit</th>
                <th>Valid Until</th>
                <th>Status</th>
                @role('Admin')
                <th>Actions</th>
                @endrole
            </tr>
        </thead>
        <tbody>
            @foreach($quotations as $quotation)
            <tr>
                <td>{{ $quotation->id }}</td>
                <td>{{ $quotation->supplier->name }}</td>
                <td>{{ $quotation->product->name }}</td>
                <td>{{ $quotation->quantity }}</td>
                <td>{{ $quotation->price_per_unit }}</td>
                <td>{{ $quotation->valid_until }}</td>
                <td>
                    @if($quotation->status === 'pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @elseif($quotation->status === 'approved')
                        <span class="badge bg-success">Approved</span>
                    @endif
                </td>
                @role('Admin')
               <td>
                    @if($quotation->status === 'pending')
                        <!-- Approve Button -->
                        <form action="{{ route('quotations.approve', $quotation->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-primary btn-sm">Approve</button>
                        </form>
                    @endif
                    <!-- Edit and Delete Actions -->
                    <a href="{{ route('quotations.edit', $quotation->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    <form action="{{ route('quotations.destroy', $quotation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quotation?')">Delete</button>
                    </form>
                </td> 
                @endrole
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
