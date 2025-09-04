@csrf

<div class="form-group">
    <label for="client">Client</label>
    <input type="text" name="client" value="{{ old('client', $shipment->client ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="internal_reference">Internal Reference</label>
    <input type="text" name="internal_reference" value="{{ old('internal_reference', $shipment->internal_reference ?? '') }}" class="form-control">
</div>

<div class="form-group">
    <label for="origin_address_id">Origin</label>
    <select name="origin_address_id" class="form-control">
        @foreach($addresses as $address)
            <option value="{{ $address->id }}" {{ (old('origin_address_id', $shipment->origin_address_id ?? '') == $address->id) ? 'selected' : '' }}>
                {{ $address->address_line_1 }} {{ $address->address_line_2 }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="destiny_address_id">Destiny</label>
    <select name="destiny_address_id" class="form-control">
        @foreach($addresses as $address)
            <option value="{{ $address->id }}" {{ (old('destiny_address_id', $shipment->destiny_address_id ?? '') == $address->id) ? 'selected' : '' }}>
                {{ $address->address_line_1 }} {{ $address->address_line_2 }}
            </option>
        @endforeach
    </select>
</div>

<button type="submit" class="btn btn-primary">Guardar</button>
