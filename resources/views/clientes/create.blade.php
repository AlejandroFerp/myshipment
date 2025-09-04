@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Cliente</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="cif" class="form-label">CIF</label>
            <input type="text" name="cif" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo</label>
            <input type="email" name="email" class="form-control">
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" class="form-control">
        </div>

        <hr>
        <h3>Dirección principal</h3>
        
        @csrf
        
        <table style="width:100%; max-width:600px; border-collapse:collapse;">
            <tr>
                <td><label for="name">Nombre</label></td>
                <td><input type="text" name="name" id="name" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="description">Descripción</label></td>
                <td><textarea name="description" id="description" style="width:100%; height:100px;"></textarea></td>
            </tr>
            <tr>
                <td><label for="address_line_1">Dirección Línea 1</label></td>
                <td><input type="text" name="address_line_1" id="address_line_1" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="address_line_2">Dirección Línea 2</label></td>
                <td><input type="text" name="address_line_2" id="address_line_2" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="district_city">Ciudad / Distrito</label></td>
                <td><input type="text" name="district_city" id="district_city" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="state_province">Provincia / Estado</label></td>
                <td><input type="text" name="state_province" id="state_province" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="postal_code">Código Postal</label></td>
                <td><input type="text" name="postal_code" id="postal_code" style="width:100%;"></td>
            </tr>
            <tr>
                <td><label for="country">País</label></td>
                <td>
                    <select name="country" id="country" style="width:100%;">
                        <option value="">Selecciona un país</option>
                        @foreach($paises as $pais)
                        <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>
    
    <button type="submit" class="btn btn-success">Guardar</button>
    <a href="{{ route('clientes.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
</div>
@endsection
