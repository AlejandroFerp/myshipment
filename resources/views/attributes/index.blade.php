@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Atributos de {{ $product->name }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('product_attributes.create', $product) }}" class="btn btn-primary mb-3">Agregar Atributo</a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary mb-3">Volver al Producto</a>

    @if($product->attributes->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Valor</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product->attributes as $attr)
                <tr>
                    <td>{{ $attr->key }}</td>
                    <td>{{ $attr->value }}</td>
                    <td>
                        <a href="{{ route('product_attributes.edit', [$product, $attr]) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('product_attributes.destroy', [$product, $attr]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar atributo?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay atributos registrados para este producto.</p>
    @endif
</div>
@endsection
