<h1>Ficha de Cliente</h1>
<p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
<p><strong>CIF:</strong> {{ $cliente->cif }}</p>
<p><strong>Email:</strong> {{ $cliente->email ?? 'Sin email' }}</p>
<p><strong>Teléfono:</strong> {{ $cliente->telefono ?? 'Sin teléfono' }}</p>

<h2>Dirección principal</h2>
@if($cliente->direcciones->count())
    @php $dir = $cliente->direcciones->first(); @endphp
    <p>{{ $dir->address_line_1 }} {{ $dir->address_line_2 }}</p>
    <p>{{ $dir->district_city }}, {{ $dir->state_province }} - {{ $dir->postal_code }}</p>
    <p>{{ $dir->country }}</p>
@endif
