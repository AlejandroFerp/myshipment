@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Wastes</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('wastes.create') }}" class="btn btn-primary mb-3">Agregar Waste</a>

    @if($wastes->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>LER</th>
                    <th>Internal Code</th>
                    <th>Comentarios</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($wastes as $waste)
                    <tr>
                        <td>
                            {{ $waste->ler ? $waste->ler->codigo . ' - ' . $waste->ler->descripcion : '-' }}
                        </td>
                        <td>{{ $waste->internal_code }}</td>
                        <td>{{ $waste->descripcion_libre ?? '-' }}</td>
                        <td>
                            <a href="{{ route('wastes.edit', $waste) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('wastes.destroy', $waste) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar este Waste?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay Wastes registrados.</p>
    @endif
</div>
@endsection
