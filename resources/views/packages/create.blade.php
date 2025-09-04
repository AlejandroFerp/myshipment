@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Add Package</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('packages.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="Reference" class="form-label">Reference</label>
            <input type="text" name="Reference" id="Reference" class="form-control" value="{{ old('Reference') }}" required>
        </div>

        <div class="mb-3">
            <label for="Shipments" class="form-label">Shipment</label>
            <input type="text" name="Shipments" id="Shipments" class="form-control" value="{{ old('Shipments') }}" required>
        </div>

        <div class="mb-3">
            <label for="Type_cargo" class="form-label">Type of Cargo</label>
            <select name="Type_cargo" id="Type_cargo" class="form-control" required>
                <option value="Pallet">Pallet</option>
                <option value="Paletina">Paletina</option>
                <option value="Package">Package</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Weight_Kg" class="form-label">Weight Kg</label>
            <input type="number" step="0.01" name="Weight_Kg" id="Weight_Kg" class="form-control" value="{{ old('Weight_Kg') }}">
        </div>

        <div class="mb-3">
            <label for="units" class="form-label">Units</label>
            <input type="number" name="units" id="units" class="form-control" value="{{ old('units') }}">
        </div>

        <div class="mb-3">
            <label for="Volume_cubic" class="form-label">Volume m³</label>
            <input type="number" step="0.01" name="Volume_cubic" id="Volume_cubic" class="form-control" value="{{ old('Volume_cubic') }}">
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea name="Description" id="Description" class="form-control">{{ old('Description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="Cost" class="form-label">Cost</label>
            <input type="number" step="0.01" name="Cost" id="Cost" class="form-control" value="{{ old('Cost') }}">
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
