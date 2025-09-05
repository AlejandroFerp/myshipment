<h1>Clientes</h1>
<a href="{{ route('home') }}">🏠 Home</a>
<a href="{{ route('clientes.create') }}">Nuevo Cliente</a>

<ul>
@foreach($clientes as $cliente)
    <li>
        Nombre: {{ $cliente->nombre }} - CIF: {{ $cliente->cif }} - Email: {{ $cliente->email ?? 'Sin email' }}
        <a href="{{ route('clientes.edit', $cliente) }}">Editar</a>

        <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>

        <!-- Botón para generar PDF -->
        <a href="{{ route('clientes.pdf', $cliente) }}" target="_blank" class="btn btn-primary btn-sm">
            Generar PDF
        </a>
        <a href="{{ route('clientes.pdf-word', $cliente) }}" target="_blank" class="btn btn-primary btn-sm">
            Generar PDF Profesional
        </a>
    </li>
@endforeach
</ul>
