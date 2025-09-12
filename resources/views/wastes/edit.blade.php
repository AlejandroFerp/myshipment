@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Waste</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('wastes.update', $waste->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="lista_ler_id" class="form-label">LER</label>
            <select name="lista_ler_id" id="lista_ler_id" class="form-control" required>
                <option value="">-- Selecciona un LER --</option>
                @foreach($listaLer as $ler)
                    <option value="{{ $ler->id }}"
                        {{ old('lista_ler_id', $waste->lista_ler_id ?? '') == $ler->id ? 'selected' : '' }}>
                        {{ $ler->codigo }} - {{ $ler->descripcion }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="internal_code" class="form-label">Código interno</label>
            <input type="number" name="internal_code" id="internal_code" class="form-control"
                   value="{{ old('internal_code', $waste->internal_code ?? '') }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion_libre" class="form-label">Comentarios</label>
            <textarea name="descripcion_libre" id="descripcion_libre" class="form-control" rows="4">{{ old('descripcion_libre', $waste->descripcion_libre ?? '') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('wastes.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
