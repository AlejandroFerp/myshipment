<!-- resources/views/autorizaciones/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Autorización</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Por favor corrige los siguientes campos:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autorizaciones.update', $autorizacion) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" id="nombre" value="{{ old('nombre', $autorizacion->nombre) }}" required>
        </div>

        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" class="form-control" id="codigo" value="{{ old('codigo', $autorizacion->codigo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control" id="descripcion" rows="3">{{ old('descripcion', $autorizacion->descripcion) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('autorizaciones.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
