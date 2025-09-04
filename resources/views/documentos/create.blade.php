<h1>Nuevo Documento</h1>
<form action="{{ route('documentos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <select name="shipment_id" required>
        <option value="">Selecciona un envio</option>
        @foreach($shipments as $shipment)
            <option value="{{ $shipment->id }}">{{ $shipment->cliente->nombre }} - {{ $shipment->tipo_residuo }}</option>
        @endforeach
    </select>
    <input type="text" name="tipo" placeholder="Tipo de documento" required>
    <input type="file" name="archivo" required>
    <button type="submit">Guardar</button>
</form>
<a href="{{ route('documentos.index') }}">Volver</a>
