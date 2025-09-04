@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Package</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('packages.update', $package) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="Reference" class="form-label">Reference</label>
            <input type="text" name="Reference" id="Reference" class="form-control" value="{{ old('Reference', $package->Reference) }}" required>
        </div>

        <div class="mb-3">
            <label for="Shipments" class="form-label">Shipment</label>
            <input type="text" name="Shipments" id="Shipments" class="form-control" value="{{ old('Shipments', $package->Shipments) }}" required>
        </div>

        <div class="mb-3">
            <label for="Type_cargo" class="form-label">Type of Cargo</label>
            <select name="Type_cargo" id="Type_cargo" class="form-control" required>
                <option value="Pallet" {{ $package->Type_cargo == 'Pallet' ? 'selected' : '' }}>Pallet</option>
                <option value="Paletina" {{ $package->Type_cargo == 'Paletina' ? 'selected' : '' }}>Paletina</option>
                <option value="Package" {{ $package->Type_cargo == 'Package' ? 'selected' : '' }}>Package</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="Weight_Kg" class="form-label">Weight Kg</label>
            <input type="number" step="0.01" name="Weight_Kg" id="Weight_Kg" class="form-control" value="{{ old('Weight_Kg', $package->Weight_Kg) }}">
        </div>

        <div class="mb-3">
            <label for="units" class="form-label">Units</label>
            <input type="number" name="units" id="units" class="form-control" value="{{ old('units', $package->units) }}">
        </div>

        <div class="mb-3">
            <label for="Volume_cubic" class="form-label">Volume m³</label>
            <input type="number" step="0.01" name="Volume_cubic" id="Volume_cubic" class="form-control" value="{{ old('Volume_cubic', $package->Volume_cubic) }}">
        </div>

        <div class="mb-3">
            <label for="Description" class="form-label">Description</label>
            <textarea name="Description" id="Description" class="form-control">{{ old('Description', $package->Description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="Cost" class="form-label">Cost</label>
            <input type="number" step="0.01" name="Cost" id="Cost" class="form-control" value="{{ old('Cost', $package->Cost) }}">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('packages.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
