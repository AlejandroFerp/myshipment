@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Editar Cliente</h1>

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

        <div class="mb-3">
            <label for="direccion_id" class="form-label">Dirección principal</label>
            <select id="direccion_id" name="direccion_id" class="form-select">
                <option value="">Seleccione una dirección</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}" 
                        {{ (string) old('direccion_id', $cliente->direccion_id) === (string) $direccion->id ? 'selected' : '' }}>
                        {{ $direccion->address_line_1 }} - {{ $direccion->district_city }}
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

<!-- Modal -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body" id="addressModalContent"></div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#direccion_id').select2({
        placeholder: "Seleccione una dirección",
        allowClear: true,
        width: '100%'
    });

    $('#direccion_id').on('select2:open', function() {
        if (!$('.select2-create-address').length) {
            const link = $('<div class="select2-create-address p-2" style="cursor:pointer;color:blue;">+ Crear nueva dirección</div>');
            link.on('click', function() {
                $('#addressModalContent').load("{{ route('direcciones.create', [
                    'direccionable_id' => $cliente->id,
                    'direccionable_type' => \App\Models\Cliente::class
                ]) }}", function() {
                    $('#addressModal').modal('show');
                    $('#addressForm').off('submit').on('submit', function(e) {
                        e.preventDefault();
                        const formData = $(this).serialize();
                        $.post("{{ route('direcciones.store') }}", formData, function(data) {
                            const newOption = new Option(data.address_line_1 + ' - ' + data.district_city, data.id, true, true);
                            $('#direccion_id').append(newOption).trigger('change');
                            $('#addressModal').modal('hide');
                        }).fail(function(xhr) {
                            alert('Error al crear la dirección');
                        });
                    });
                });
                $('.select2-dropdown').hide();
            });
            $('.select2-dropdown').append(link);
        }
    });
});
</script>
@endsection
