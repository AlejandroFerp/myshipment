@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Productos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>

    @if($products->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>SKU</th>
                    <th>Stock</th>
                    <th>Precio</th>
                    <th>Waste</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->type }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->sku ?? '-' }}</td>
                    <td>{{ $product->stock ?? '-' }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->waste->name ?? '-' }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay productos registrados.</p>
    @endif
</div>
@endsection
