@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>

    <form action="{{ route('products.update', $product) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campos básicos -->
        <div class="mb-3">
            <label>Tipo</label>
            <select name="type" class="form-control">
                <option value="service" {{ $product->type === 'service' ? 'selected' : '' }}>Servicio</option>
                <option value="item" {{ $product->type === 'item' ? 'selected' : '' }}>Item</option>
                <option value="waste" {{ $product->type === 'waste' ? 'selected' : '' }}>Desecho</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $product->name }}" required>
        </div>

        <div class="mb-3">
            <label>Descripción</label>
            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
        </div>

        <div class="mb-3">
            <label>Precio</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ $product->price }}" required>
        </div>

        <div class="mb-3">
            <label>SKU</label>
            <input type="text" name="sku" class="form-control" value="{{ $product->sku }}">
        </div>

        <div class="mb-3">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" value="{{ $product->stock }}">
        </div>

        <div class="mb-3">
            <label>Waste</label>
            <select name="waste_id" class="form-control">
                <option value="">-- Seleccionar --</option>
                @foreach($wastes as $waste)
                    <option value="{{ $waste->id }}" {{ $product->waste_id == $waste->id ? 'selected' : '' }}>
                        {{ $waste->name }}
                    </option>
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
        <div id="attribute-fields" class="mt-3">
            @foreach($product->attributes as $attr)
                <div class="mb-3" id="attr-field-{{ $attr->id }}">
                    <label for="attr-{{ $attr->id }}">{{ $attr->name }}:</label>
                    <input type="{{ $attr->type === 'decimal' ? 'number' : 'text' }}"
                           id="attr-{{ $attr->id }}"
                           name="attributes[{{ $attr->id }}]"
                           class="form-control"
                           value="{{ $attr->pivot->value }}"
                           {{ $attr->type === 'decimal' ? 'step=0.01' : '' }}>
                    <button type="button" class="btn btn-sm btn-danger mt-1 remove-attr">Quitar</button>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
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

        if ($('#attr-field-' + attrId).length) {
            $('#attribute-selector').val(null).trigger('change');
            return;
        }

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

        const option = $('#attribute-selector option[value="'+attrId+'"]');
        option.remove();
        $('#attribute-selector').val(null).trigger('change');
    });

    container.on('click', '.remove-attr', function() {
        const parentDiv = $(this).closest('div');
        const id = parentDiv.attr('id').replace('attr-field-', '');
        const name = parentDiv.find('label').text().replace(':','');
        $('#attribute-selector').append(new Option(name, id, false, false));
        parentDiv.remove();
    });
});
</script>
@endsection
