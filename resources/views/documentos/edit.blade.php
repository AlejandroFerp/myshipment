<h1>Editar Documento</h1>
<form action="{{ route('documentos.update', $documento) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <select name="envio_id" required>
        @foreach($shipments as $shipment)
            <option value="{{ $shipment->id }}" @if($documento->shipment_id==$shipment->id) selected @endif>
                {{ $shipment->cliente->nombre }} - {{ $shipment->tipo_residuo }}
            </option>
        @endforeach
    </select>
    <input type="text" name="tipo" value="{{ $documento->tipo }}" required>
    <input type="file" name="archivo">
    <button type="submit">Actualizar</button>
</form>
<a href="{{ route('documentos.index') }}">Volver</a>
