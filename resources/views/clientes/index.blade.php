@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0"> Clientes</h1>
    <div>
        <a href="{{ route('clientes.create') }}" class="btn btn-success">
            <i class="bi bi-person-plus"></i> Nuevo Cliente
        </a>
    </div>
</div>

@if($clientes->isEmpty())
    <div class="alert alert-info">
        No hay clientes registrados todavía.
    </div>
@else
    <div class="table-responsive">
        <table class="table table-hover align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>CIF</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->cif }}</td>
                        <td>{{ $cliente->email ?? '📭 Sin email' }}</td>
                        <td>{{ $cliente->telefono}}</td>
                        <td class="text-center">
                            <a href="{{ route('clientes.edit', $cliente) }}" class="btn btn-sm btn-warning me-1">
                                <i class="bi bi-pencil-square"></i> </a>

                            <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este cliente?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger me-1">
                                    <i class="bi bi-trash"></i> 
                                </button>
                            </form>
                            <!-- Nuevo botón: Añadir Centro -->
                            <a href="{{ route('centros.create') }}?cliente_id={{ $cliente->id }}" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Añadir Centro">
                                <i class="bi bi-building-add"></i>
                            </a>

                            <!-- Nuevo botón: Ver Centros del Cliente -->
                            <a href="{{ route('centros.index') }}?cliente_id={{ $cliente->id }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            title="Ver Centos">
                                <i class="bi bi-building"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
@endsection
