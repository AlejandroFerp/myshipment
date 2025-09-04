<!-- resources/views/autonomic_communities/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Comunidad Autónoma</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autonomic_communities.update', $autonomicCommunity) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $autonomicCommunity->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $autonomicCommunity->code) }}" required>
        </div>

        <div class="mb-3">
            <label for="address_id" class="form-label">Dirección</label>
            <select name="address_id" id="address_id" class="form-control">
                <option value="">Seleccione una dirección</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}" {{ old('address_id', $autonomicCommunity->address_id) == $direccion->id ? 'selected' : '' }}>
                        {{ $direccion->address_line_1 }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('autonomic_communities.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
