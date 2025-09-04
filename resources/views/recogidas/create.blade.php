<h1>Nueva Recogida</h1>
<form action="{{ route('recogidas.store') }}" method="POST">
    @csrf
    <select name="shipment_id" required>
        <option value="">Selecciona un envio</option>
        @foreach($shipments as $shipment)
            <option value="{{ $shipment->id }}">{{ $shipment->cliente->nombre }} - {{ $shipment->tipo_residuo }}</option>
        @endforeach
    </select>
    <input type="date" name="fecha_recogida" required>
    <input type="text" name="observaciones" placeholder="Observaciones">
    <button type="submit">Guardar</button>
</form>
<a href="{{ route('recogidas.index') }}">Volver</a>
