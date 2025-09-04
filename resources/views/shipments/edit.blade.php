@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Shipment</h1>
    <form action="{{ route('shipments.update', $shipment) }}" method="POST">
        @csrf
        @method('PUT')
        @include('shipments._form')
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
