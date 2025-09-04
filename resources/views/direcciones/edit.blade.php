<h1>Editar Dirección</h1>

<form action="{{ route('direcciones.update', $direccion) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="name" value="{{ old('name', $direccion->name) }}" placeholder="Nombre">
    
    <textarea name="description" style="height:100px;" placeholder="Descripción">{{ old('description', $direccion->description) }}</textarea>

    <input type="text" name="address_line_1" value="{{ old('address_line_1', $direccion->address_line_1) }}" placeholder="Dirección Línea 1">
    <input type="text" name="address_line_2" value="{{ old('address_line_2', $direccion->address_line_2) }}" placeholder="Dirección Línea 2">
    <input type="text" name="district_city" value="{{ old('district_city', $direccion->district_city) }}" placeholder="Ciudad / Distrito">
    <input type="text" name="state_province" value="{{ old('state_province', $direccion->state_province) }}" placeholder="Provincia / Estado">
    <input type="text" name="postal_code" value="{{ old('postal_code', $direccion->postal_code) }}" placeholder="Código Postal">
    <input type="text" name="country" value="{{ old('country', $direccion->country) }}" placeholder="País">

    <input type="text" name="latitude" value="{{ old('latitude', $direccion->latitude) }}" placeholder="Latitud">
    <input type="text" name="longitude" value="{{ old('longitude', $direccion->longitude) }}" placeholder="Longitud">

    <button type="submit">Actualizar</button>
</form>

<a href="{{ route('direcciones.index') }}">Volver</a>
