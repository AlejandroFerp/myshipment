<!-- resources/views/environmental_authorizations/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Autorización Medioambiental</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Corrige los siguientes campos:<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autorizacionesMedioambientales.update', $autorizacionMedioambiental) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="autorizacion_id" class="form-label">Autorización</label>
            <select name="autorizacion_id" id="autorizacion_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($autorizaciones as $autorizacion)
                    <option value="{{ $autorizacion->id }}" {{ old('autorizacion_id', $autorizacionMedioambiental->autorizacion_id) == $autorizacion->id ? 'selected' : '' }}>
                        {{ $autorizacion->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="center_id" class="form-label">Centro</label>
            <select name="center_id" id="center_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($centros as $center)
                    <option value="{{ $center->id }}" {{ old('center_id', $autorizacionMedioambiental->center_id) == $center->id ? 'selected' : '' }}>
                        {{ $center->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code', $autorizacionMedioambiental->code) }}" required>
        </div>

        <div class="mb-3">
            <label for="autonomic_community_id" class="form-label">Comunidad Autónoma</label>
            <select name="autonomic_community_id" id="autonomic_community_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($autonomicCommunities as $community)
                    <option value="{{ $community->id }}" {{ old('autonomic_community_id', $autorizacionMedioambiental->autonomic_community_id) == $community->id ? 'selected' : '' }}>
                        {{ $community->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="type_of_authorization_id" class="form-label">Tipo de Autorización</label>
            <select name="type_of_authorization_id" id="type_of_authorization_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($typeOfAuthorizations as $type)
                    <option value="{{ $type->id }}" {{ old('type_of_authorization_id', $autorizacionMedioambiental->type_of_authorization_id) == $type->id ? 'selected' : '' }}>
                        {{ $type->code }} - {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="waste_id" class="form-label">Residuo</label>
            <select name="waste_id" id="waste_id" class="form-control" required>
                <option value="">Seleccione...</option>
                @foreach($wastes as $waste)
                    <option value="{{ $waste->id }}" {{ old('waste_id', $autorizacionMedioambiental->waste_id) == $waste->id ? 'selected' : '' }}>
                        {{ $waste->code }} - {{ $waste->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="lers" class="form-label">LERS</label>
            <input type="text" name="lers" id="lers" class="form-control" value="{{ old('lers', $autorizacionMedioambiental->lers) }}">
        </div>

        <div class="mb-3">
            <label for="pdf" class="form-label">PDF</label>
            @if($autorizacionMedioambiental->pdf)
                <p>Archivo actual: <a href="{{ asset('storage/' . $autorizacionMedioambiental->pdf) }}" target="_blank">Ver PDF</a></p>
            @endif
            <input type="file" name="pdf" id="pdf" class="form-control" accept="application/pdf">
            <small class="form-text text-muted">Si subes un nuevo archivo, reemplazará el actual.</small>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('autorizacionesMedioambientales.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
