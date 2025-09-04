<!-- resources/views/autorizaciones/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Autorizaciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('autorizaciones.create') }}" class="btn btn-primary mb-3">Crear Nueva Autorización</a>

    @if($autorizaciones->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autorizaciones as $autorizacion)
                    <tr>
                        <td>{{ $autorizacion->id }}</td>
                        <td>{{ $autorizacion->nombre }}</td>
                        <td>{{ $autorizacion->codigo }}</td>
                        <td>{{ $autorizacion->descripcion }}</td>
                        <td>
                            <a href="{{ route('autorizaciones.show', $autorizacion) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('autorizaciones.edit', $autorizacion) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('autorizaciones.destroy', $autorizacion) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Estás seguro de eliminar esta autorización?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay autorizaciones registradas.</p>
    @endif
</div>
@endsection
