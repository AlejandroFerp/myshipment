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

        <!-- Datos generales del cliente -->
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

        <!-- Selector múltiple de residuos usando Select2 -->
        <div class="mb-3">
            <label for="wastes" class="form-label">Residuos permitidos</label>
            <select name="wastes[]" id="wastes" class="form-control" multiple>
                @foreach ($wastes as $waste)
                    <option value="{{ $waste->id }}"
                        {{ isset($cliente) && $cliente->wastes->contains($waste->id) ? 'selected' : '' }}>
                        {{ $waste->internal_code }} - {{ $waste->lista_ler?->descripcion ?? 'sin LER' }}
                    </option>
                @endforeach
            </select>
        </div>

        <hr>
        <h3>Dirección principal</h3>

        <table class="table table-borderless" style="max-width:600px;">
            <tr>
                <td><label for="name">Nombre</label></td>
                <td><input type="text" name="name" id="name" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="description">Descripción</label></td>
                <td><textarea name="description" id="description" class="form-control" rows="3"></textarea></td>
            </tr>
            <tr>
                <td><label for="address_line_1">Dirección Línea 1</label></td>
                <td><input type="text" name="address_line_1" id="address_line_1" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="address_line_2">Dirección Línea 2</label></td>
                <td><input type="text" name="address_line_2" id="address_line_2" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="district_city">Ciudad / Distrito</label></td>
                <td><input type="text" name="district_city" id="district_city" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="state_province">Provincia / Estado</label></td>
                <td><input type="text" name="state_province" id="state_province" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="postal_code">Código Postal</label></td>
                <td><input type="text" name="postal_code" id="postal_code" class="form-control"></td>
            </tr>
            <tr>
                <td><label for="country">País</label></td>
                <td>
                    <select name="country" id="country" class="form-control">
                        <option value="">Selecciona un país</option>
                        @foreach ($paises as $pais)
                            <option value="{{ $pais }}">{{ $pais }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
        </table>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('clientes.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $('#wastes').select2({
        placeholder: "Selecciona residuos",
        allowClear: true,
        width: '100%'
    });
});
</script>
@endsection
