@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Shipments</h1>
    <a href="{{ route('shipments.create') }}" class="btn btn-primary mb-3">Add Shipment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Internal Reference</th>
                <th>Client</th>
                <th>Carrier</th>
                <th>Origin</th>
                <th>Destiny</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipments as $shipment)
            <tr>
                <td>{{ $shipment->id }}</td>
                <td>{{ $shipment->internal_reference }}</td>
                <td>{{ $shipment->client }}</td>
                <td>{{ $shipment->carrier->name ?? '' }}</td>
                <td>{{ $shipment->origin->full_address ?? '' }}</td>
                <td>{{ $shipment->destiny->full_address ?? '' }}</td>
                <td>
                    <a href="{{ route('shipments.show', $shipment) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('shipments.edit', $shipment) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('shipments.destroy', $shipment) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
