<h1>Recogidas</h1>
<a href="{{ route('home') }}">🏠 Home</a>
<a href="{{ route('recogidas.create') }}">Nueva Recogida</a>
<ul>
@foreach($recogidas as $recogida)
    <li>
        {{ $recogida->envio->cliente->nombre }} - {{ $recogida->fecha_recogida }}
        <a href="{{ route('recogidas.edit', $recogida) }}">Editar</a>
        <form action="{{ route('recogidas.destroy', $recogida) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </li>
@endforeach
</ul>
