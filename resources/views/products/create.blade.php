@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Producto</h1>

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <!-- Campos básicos -->
        <div class="mb-3">
            <label>Tipo</label>
            <select name="type" class="form-control">
                <option value="service">Servicio</option>
                <option value="item">Item</option>
                <option value="waste">Desecho</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="price" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control">
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control">
        </div>

        <div class="mb-3">
            <label>Waste</label>
            <select name="waste_id" class="form-control">
                <option value="">-- Seleccionar --</option>
                @foreach($wastes as $waste)
                    <option value="{{ $waste->id }}">{{ $waste->name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Selector de atributos -->
        <h4>Atributos</h4>
        <select id="attribute-selector" class="form-control">
            <option value="">-- Selecciona un atributo --</option>
            @foreach($attributes as $attribute)
                <option value="{{ $attribute->id }}" data-name="{{ $attribute->name }}" data-type="{{ $attribute->type }}">
                    {{ ucfirst($attribute->name) }}
                </option>
            @endforeach
        </select>

        <!-- Contenedor de inputs dinámicos -->
        <div id="attribute-fields" class="mt-3"></div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Inicializar Select2
    $('#attribute-selector').select2({
        placeholder: "-- Selecciona un atributo --",
        allowClear: true
    });

    const container = $('#attribute-fields');

    $('#attribute-selector').on('select2:select', function(e) {
        const data = e.params.data.element.dataset;
        const attrId = e.params.data.id;
        const attrName = data.name;
        const attrType = data.type;

        // Evitar duplicados
        if ($('#attr-field-' + attrId).length) {
            $('#attribute-selector').val(null).trigger('change');
            return;
        }

        // Crear input según tipo
        let inputType = attrType === 'decimal' ? 'number' : 'text';
        let stepAttr = attrType === 'decimal' ? ' step="0.01"' : '';

        const fieldHtml = `
            <div class="mb-3" id="attr-field-${attrId}">
                <label for="attr-${attrId}">${attrName}:</label>
                <input type="${inputType}" id="attr-${attrId}" name="attributes[${attrId}]" class="form-control" placeholder="Ingrese ${attrName}"${stepAttr}>
                <button type="button" class="btn btn-sm btn-danger mt-1 remove-attr">Quitar</button>
            </div>
        `;

        container.append(fieldHtml);

        // Quitar opción del selector
        const option = $('#attribute-selector option[value="'+attrId+'"]');
        option.remove();
        $('#attribute-selector').val(null).trigger('change');

        // Quitar campo
        container.on('click', '.remove-attr', function() {
            const parentDiv = $(this).closest('div');
            const id = parentDiv.attr('id').replace('attr-field-', '');
            const name = parentDiv.find('label').text().replace(':','');

            // Reinsertar opción al selector
            $('#attribute-selector').append(new Option(name, id, false, false));
            parentDiv.remove();
        });
    });
});
</script>
@endsection
