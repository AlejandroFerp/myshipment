<h1>Editar Cliente</h1>
<form action="{{ route('clientes.update', $cliente) }}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="nombre" value="{{ $cliente->nombre }}" required>
    <input type="text" name="cif" value="{{ old('cif', $cliente->cif) }}" required>
    <input type="email" name="email" value="{{ $cliente->email }}">
    <input type="text" name="telefono" value="{{ $cliente->telefono }}">
    <input type="text" name="direccion" value="{{ $cliente->direccion }}">
    <button type="submit">Actualizar</button>
</form>
<a href="{{ route('clientes.index') }}">Volver</a>
