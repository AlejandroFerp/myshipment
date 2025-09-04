@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Centro</h1>

    <form action="{{ route('centros.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select name="cliente_id" id="cliente_id" class="form-control" required>
                <option value="">-- Selecciona un cliente --</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>
                        {{ $cliente->nombre }}
                    </option>
                @endforeach
            </select>
            @error('cliente_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="direccion_id" class="form-label">Dirección</label>
            <select name="direccion_id" id="direccion_id" class="form-control">
                <option value="">-- Opcional --</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}" {{ old('direccion_id') == $direccion->id ? 'selected' : '' }}>
                        {{ $direccion->calle ?? '' }} {{ $direccion->ciudad ?? '' }}
                    </option>
                @endforeach
            </select>
            @error('direccion_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
            <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control" value="{{ old('nombre_comercial') }}" required>
            @error('nombre_comercial') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nima" class="form-label">NIMA</label>
            <input type="text" name="nima" id="nima" class="form-control" value="{{ old('nima') }}">
            @error('nima') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="tarifa" class="form-label">Tarifa</label>
            <input type="number" step="0.01" name="tarifa" id="tarifa" class="form-control" value="{{ old('tarifa') }}">
            @error('tarifa') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
            <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control" value="{{ old('nombre_contacto') }}">
            @error('nombre_contacto') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono') }}">
            @error('telefono') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
            @error('email') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label for="detalle_envio" class="form-label">Detalle de Envío</label>
            <textarea name="detalle_envio" id="detalle_envio" class="form-control">{{ old('detalle_envio') }}</textarea>
            @error('detalle_envio') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('centros.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
