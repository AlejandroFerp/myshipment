<h1>Documentos</h1>
<a href="{{ route('home') }}">🏠 Home</a>
<a href="{{ route('documentos.create') }}">Nuevo Documento</a>
<ul>
@foreach($documentos as $doc)
    <li>
        {{ $doc->envio->cliente->nombre }} - {{ $doc->tipo }}
        <a href="{{ route('documentos.edit', $doc) }}">Editar</a>
        <form action="{{ route('documentos.destroy', $doc) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit">Eliminar</button>
        </form>
        <a href="{{ Storage::url($doc->ruta_archivo) }}" target="_blank">Ver archivo</a>
    </li>
@endforeach
</ul>
