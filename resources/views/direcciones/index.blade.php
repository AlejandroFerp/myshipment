<h1>Direcciones</h1>

<a href="{{ route('home') }}">🏠 Home</a>
<a href="{{ route('direcciones.create') }}">Nueva Dirección</a>

<ul>
@foreach($direcciones as $direccion)
    <li>
        Nombre: {{ $direccion->name }} — Ciudad: {{ $direccion->district_city }} — País: {{ $direccion->country }}
        <a href="{{ route('direcciones.edit', $direccion) }}">Editar</a>
        <form action="{{ route('direcciones.destroy', $direccion) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
    </li>
@endforeach
</ul>
