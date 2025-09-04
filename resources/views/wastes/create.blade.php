@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Agregar Waste</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('wastes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="lers" class="form-label">LERS</label>
            <input type="text" name="lers" id="lers" class="form-control" value="{{ old('lers') }}">
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Code</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="4">{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('wastes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
