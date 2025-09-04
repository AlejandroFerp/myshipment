@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Packages</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('packages.create') }}" class="btn btn-primary mb-3">Add Package</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Reference</th>
                <th>Shipment</th>
                <th>Type Cargo</th>
                <th>Weight Kg</th>
                <th>Units</th>
                <th>Volume m³</th>
                <th>Cost</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($packages as $package)
            <tr>
                <td>{{ $package->id }}</td>
                <td>{{ $package->Reference }}</td>
                <td>{{ $package->Shipments }}</td>
                <td>{{ $package->Type_cargo }}</td>
                <td>{{ $package->Weight_Kg }}</td>
                <td>{{ $package->units }}</td>
                <td>{{ $package->Volume_cubic }}</td>
                <td>{{ $package->Cost }}</td>
                <td>
                    <a href="{{ route('packages.edit', $package) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('packages.destroy', $package) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
