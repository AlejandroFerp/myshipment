<h1>Nuevo Envio</h1>
<form action="{{ route('shipments.store') }}" method="POST">
    @csrf
    <select name="cliente_id" required>
        <option value="">Selecciona un cliente</option>
        @foreach($clientes as $cliente)
            <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
        @endforeach
    </select>
    <input type="text" name="tipo_residuo" placeholder="Tipo de residuo" required>
    <input type="number" name="cantidad" placeholder="Cantidad">
    <input type="date" name="fecha_envio" required>
    <button type="submit">Guardar</button>
</form>
<a href="{{ route('shipments.index') }}">Volver</a>
