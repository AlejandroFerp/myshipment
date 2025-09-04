<!-- resources/views/environmental_authorizations/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Autorizaciones Medioambientales</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('autorizacionesMedioambientales.create') }}" class="btn btn-primary mb-3">Crear Nueva Autorización</a>

    @if($envAuths->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Autorización</th>
                    <th>Centro</th>
                    <th>Código</th>
                    <th>Comunidad Autónoma</th>
                    <th>Tipo de Autorización</th>
                    <th>Residuo</th>
                    <th>LERS</th>
                    <th>PDF</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($envAuths as $envAuth)
                    <tr>
                        <td>{{ $envAuth->id }}</td>
                        <td>{{ $envAuth->autorizacion->nombre }}</td>
                        <td>{{ $envAuth->center->name ?? '-' }}</td>
                        <td>{{ $envAuth->code }}</td>
                        <td>{{ $envAuth->autonomicCommunity->name ?? '-' }}</td>
                        <td>{{ $envAuth->typeOfAuthorization->name ?? '-' }}</td>
                        <td>{{ $envAuth->waste->name ?? '-' }}</td>
                        <td>{{ $envAuth->lers }}</td>
                        <td>
                            @if($envAuth->pdf)
                                <a href="{{ asset('storage/' . $envAuth->pdf) }}" target="_blank">Ver PDF</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('autorizacionesMedioambientales.edit', $envAuth) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('autorizacionesMedioambientales.destroy', $envAuth) }}" method="POST" style="display:inline-block;">
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
        <p>No hay autorizaciones medioambientales registradas.</p>
    @endif
</div>
@endsection
