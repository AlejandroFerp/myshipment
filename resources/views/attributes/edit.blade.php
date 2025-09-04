@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Editar Atributo de {{ $product->name }}</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('product_attributes.update', [$product, $attribute]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Clave</label>
            <input type="text" name="key" class="form-control" value="{{ old('key', $attribute->key) }}" required>
        </div>
        <div class="mb-3">
            <label>Valor</label>
            <input type="text" name="value" class="form-control" value="{{ old('value', $attribute->value) }}">
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('products.edit', $product) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
