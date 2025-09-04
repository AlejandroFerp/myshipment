<!-- resources/views/autonomic_communities/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Comunidades Autónomas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('autonomic_communities.create') }}" class="btn btn-primary mb-3">Crear Nueva Comunidad</a>

    @if($autonomicCommunities->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Dirección</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($autonomicCommunities as $community)
                    <tr>
                        <td>{{ $community->id }}</td>
                        <td>{{ $community->name }}</td>
                        <td>{{ $community->code }}</td>
                        <td>{{ $community->address->address_line_1 ?? '-' }}</td>
                        <td>
                            <a href="{{ route('autonomic_communities.edit', $community) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('autonomic_communities.destroy', $community) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('¿Seguro que quieres eliminar esta comunidad?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay comunidades registradas.</p>
    @endif
</div>
@endsection
