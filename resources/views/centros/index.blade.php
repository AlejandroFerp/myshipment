@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Centros</h1>

    <a href="{{ route('centros.create') }}" class="btn btn-success mb-3">➕ Nuevo Centro</a>

    @if($centros->isEmpty())
        <div class="alert alert-info">
            No hay centros registrados todavía.
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nombre Comercial</th>
                    <th>Cliente</th>
                    <th>NIMA</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($centros as $centro)
                    <tr>
                        <td>{{ $centro->nombre_comercial }}</td>
                        <td>{{ $centro->cliente->nombre ?? '—' }}</td>
                        <td>{{ $centro->nima ?? '—' }}</td>
                        <td>{{ $centro->telefono ?? '—' }}</td>
                        <td>{{ $centro->email ?? '—' }}</td>
                        <td>
                            <a href="{{ route('centros.index', $centro) }}" class="btn btn-info btn-sm">👁 Ver</a>
                            <a href="{{ route('centros.edit', $centro) }}" class="btn btn-primary btn-sm">✏ Editar</a>
                            <a href="{{ route('centros.contrato', $centro) }}" class="btn btn-warning btn-sm">📄 Contrato</a>
                            <form action="{{ route('centros.destroy', $centro) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar este centro?')">
                                    🗑 Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
