@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Shipment</h1>
    <form action="{{ route('shipments.store') }}" method="POST">
        @csrf
        @include('shipments._form')
        <button type="submit" class="btn btn-success">Send</button>
        <a href="{{ route('shipments.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
