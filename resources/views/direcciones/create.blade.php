<h1>Nueva Dirección</h1>

<form action="{{ route('direcciones.store') }}" method="POST">
    @csrf
    <input type="hidden" name="direccionable_id" value="{{ $direccionable_id }}">
    <input type="hidden" name="direccionable_type" value="{{ $direccionable_type }}">
    
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
        <tr>
            <td><label for="latitude">Latitud</label></td>
            <td><input type="text" name="latitude" id="latitude" style="width:100%;"></td>
        </tr>
        <tr>
            <td><label for="longitude">Longitud</label></td>
            <td><input type="text" name="longitude" id="longitude" style="width:100%;"></td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:right;">
                <button type="submit">Guardar</button>
            </td>
        </tr>
    </table>
</form>

<br>
<a href="{{ route('direcciones.index') }}">Volver</a>
