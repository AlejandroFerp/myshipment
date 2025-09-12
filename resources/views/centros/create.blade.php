@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Crear Centro</h1>

        <!-- Errores generales -->
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-3 rounded mb-4">
                <strong>Ups! Hubo algunos problemas:</strong>
                <ul class="mt-2 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('centros.store') }}" method="POST">
            @csrf
            <div class="row g-3">

                <!-- Cliente -->
                <div class="col-md-6">
                    <label for="cliente_id" class="form-label">Cliente</label>
                    <select name="cliente_id" id="cliente_id" class="form-select" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach ($clientes as $cliente)
                            <option value="{{ $cliente->id }}"
                                {{ (string) old('cliente_id', $cliente_id ?? '') === (string) $cliente->id ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>

                    <select name="wastes[]" id="wastes" class="form-control" multiple>
                        @foreach ($residuosDisponibles as $waste)
                            <option value="{{ $waste->id }}"
                                {{ isset($centro) && $centro->wastes->contains($waste->id) ? 'selected' : '' }}>
                                {{ $waste->code }} - {{ $waste->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('cliente_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Dirección -->
                <div class="col-md-6">
                    <label for="direccion_id" class="form-label">Dirección principal</label>
                    <select id="direccion_id" name="direccion_id" class="form-select">
                        <option value="">Seleccione una dirección</option>
                        @foreach ($direcciones as $direccion)
                            <option value="{{ $direccion->id }}"
                                {{ (string) old('direccion_id', $cliente->direccion_id ?? '') === (string) $direccion->id ? 'selected' : '' }}>
                                {{ $direccion->address_line_1 }} - {{ $direccion->district_city }}
                            </option>
                        @endforeach
                    </select>
                    @error('direccion_id')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombre Comercial -->
                <div class="col-md-6">
                    <label for="nombre_comercial" class="form-label">Nombre Comercial</label>
                    <input type="text" name="nombre_comercial" id="nombre_comercial" class="form-control"
                        value="{{ old('nombre_comercial') }}" required>
                    @error('nombre_comercial')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- NIMA -->
                <div class="col-md-6">
                    <label for="nima" class="form-label">NIMA</label>
                    <input type="text" name="nima" id="nima" class="form-control" value="{{ old('nima') }}">
                    @error('nima')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Tarifa -->
                <div class="col-md-6">
                    <label for="tarifa" class="form-label">Tarifa</label>
                    <input type="number" step="0.01" name="tarifa" id="tarifa" class="form-control"
                        value="{{ old('tarifa') }}" required>
                    @error('tarifa')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Nombre de Contacto -->
                <div class="col-md-6">
                    <label for="nombre_contacto" class="form-label">Nombre de Contacto</label>
                    <input type="text" name="nombre_contacto" id="nombre_contacto" class="form-control"
                        value="{{ old('nombre_contacto') }}">
                    @error('nombre_contacto')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Teléfono -->
                <div class="col-md-6">
                    <label for="telefono" class="form-label">Teléfono</label>
                    <input type="text" name="telefono" id="telefono" class="form-control"
                        value="{{ old('telefono') }}">
                    @error('telefono')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
                <!-- residuos -->
                <div class="form-group">
                    <label for="wastes">Residuos del centro</label>
                    <select name="wastes[]" id="wastes" class="form-control" multiple>
                        @foreach ($residuosDisponibles as $waste)
                            <option value="{{ $waste->id }}"
                                {{ isset($centro) && $centro->wastes->contains($waste->id) ? 'selected' : '' }}>
                                {{ $waste->code }} - {{ $waste->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Correo electrónico</label>
                    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}">
                    @error('email')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Detalles del Envío -->
                <div class="col-12">
                    <label for="detalle_envio" class="form-label">Detalles del Envío</label>
                    <textarea name="detalle_envio" id="detalle_envio" class="form-control" rows="4">{{ old('detalle_envio') }}</textarea>
                    @error('detalle_envio')
                        <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a href="{{ route('centros.index') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>

    <!-- Modal para crear direcciones -->
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
                    const link = $(
                        '<div class="select2-create-address p-2" style="cursor:pointer;color:blue;">+ Crear nueva dirección</div>'
                    );
                    link.on('click', function() {
                        $('#addressModalContent').load(
                            "{{ route('direcciones.create', [
                                'direccionable_id' => $cliente_id ?? '',
                                'direccionable_type' => \App\Models\Cliente::class,
                            ]) }}",
                            function() {
                                $('#addressModal').modal('show');
                                $('#addressForm').off('submit').on('submit', function(e) {
                                    e.preventDefault();
                                    const formData = $(this).serialize();
                                    $.post("{{ route('direcciones.store') }}",
                                        formData,
                                        function(data) {
                                            const newOption = new Option(data
                                                .address_line_1 + ' - ' + data
                                                .district_city, data.id, true,
                                                true);
                                            $('#direccion_id').append(newOption)
                                                .trigger('change');
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

        document.addEventListener('DOMContentLoaded',function()){
            const   clienteSelect = document.getElementById('cliente_id');
            const   wastesSelect = document.getElementById('wastes');
            clienteSelect.addEventListener('change', function()){
                const   clienteId = this.value;

                // Limpiar opciones actuales
                wastesSelect.innerHTML = '';

                if(!clienteId) return;
                fetch(`/clientes/${clienteId}/residuos`)
                    .then(res => res.json())
                    .then(data => {
                        data.forEach(w => {
                            const option = document.createElement('option');
                            option.value = w.id;
                            option.textContent = `${w.code}-${w.name}`;
                            wastesSelect.appendChild(option);
                        });

                    }).catch(err => console.error('Error cargando residuos:',err));
            }
        }
    </script>
@endsection
