@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Cliente</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('clientes.update', $cliente) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input type="text" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">CIF</label>
            <input type="text" name="cif" value="{{ old('cif', $cliente->cif) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $cliente->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" class="form-control">
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

        <!-- Dirección principal -->
        <div class="mb-3">
            <label for="direccion_id" class="form-label">Dirección principal</label>
            <select id="direccion_id" name="direccion_id" class="form-select">
                <option value="">Seleccione una dirección</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}"
                        {{ (string) old('direccion_id', $cliente->direccion_id) === (string) $direccion->id ? 'selected' : '' }}>
                        {{ $direccion->address_line_1 }} - {{ $direccion->district_city }} ({{ $direccion->country }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">
                <i class="bi bi-check-circle"></i> Actualizar
            </button>
            <a href="{{ route('clientes.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left-circle"></i> Volver
            </a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Inicializa multiselect para residuos
        $('#wastes').multiselect({
            includeSelectAllOption: true,
            enableFiltering: true,
            buttonWidth: '100%',
            maxHeight: 300,
            nonSelectedText: 'Selecciona residuos'
        });

        // Inicializa Select2 para direcciones
        $('#direccion_id').select2({
            placeholder: "Seleccione una dirección",
            allowClear: true,
            width: '100%'
        });
    });
</script>
@endsection
