@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Crear Nueva Comunidad Autónoma</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('autonomic_communities.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="code" class="form-label">Código</label>
            <input type="text" name="code" id="code" class="form-control" value="{{ old('code') }}" required>
        </div>

        <div class="mb-3">
            <label for="address_id" class="form-label">Dirección</label>
            <select name="address_id" id="address_id" class="form-control">
                <option value="">Seleccione una dirección</option>
                @foreach($direcciones as $direccion)
                    <option value="{{ $direccion->id }}" {{ old('address_id') == $direccion->id ? 'selected' : '' }}>
                        {{ $direccion->address_line_1 }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('autonomic_communities.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<!-- Modal para cargar el formulario real -->
<div class="modal fade" id="addressModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body" id="addressModalContent">
        <!-- Aquí se cargará el formulario real -->
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#address_id').select2({
        placeholder: "Seleccione una dirección",
        allowClear: true,
        width: '100%'
    });

    // Agregar opción de "Crear nueva dirección"
    $('#address_id').on('select2:open', function() {
        if (!$('.select2-create-address').length) {
            const link = $('<div class="select2-create-address p-2" style="cursor:pointer;color:blue;">+ Crear nueva dirección</div>');
            link.on('click', function() {
                // Abrir modal y cargar formulario real
                $('#addressModalContent').load("{{ route('direcciones.create') }}", function() {
                    $('#addressModal').modal('show');

                    // Rebind form submission dentro del modal
                    $('#addressForm').submit(function(e) {
                        e.preventDefault();
                        const formData = $(this).serialize();

                        $.post("{{ route('direcciones.store') }}", formData, function(data) {
                            const newOption = new Option(data.address_line_1, data.id, true, true);
                            $('#address_id').append(newOption).trigger('change');
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
