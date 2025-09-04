<h1>Editar Recogida</h1>
<form action="{{ route('recogidas.update', $recogida) }}" method="POST">
    @csrf
    @method('PUT')
    <select name="shipment_id" required>
        @foreach($shipments as $shipment)
            <option value="{{ $shipment->id }}" @if($recogida->shipment_id==$shipment->id) selected @endif>
                {{ $shipment->cliente->nombre }} - {{ $shipment->tipo_residuo }}
            </option>
        @endforeach
    </select>
    <input type="date" name="fecha_recogida" value="{{ $recogida->fecha_recogida->format('Y-m-d') }}" required>
    <input type="text" name="observaciones" value="{{ $recogida->observaciones }}">
    <button type="submit">Actualizar</button>
</form>
<a href="{{ route('recogidas.index') }}">Volver</a>
