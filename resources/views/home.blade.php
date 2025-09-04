<!DOCTYPE html>
<html>
<head>
    <title>Inicio</title>
</head>
<body>
    <h1>Bienvenido a la aplicación</h1>
    <ul>
        <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
        <li><a href="{{ route('documentos.index') }}">Documentos</a></li>
        <li><a href="{{ route('shipments.index') }}">Envíos</a></li>
        <li><a href="{{ route('recogidas.index') }}">Recogidas</a></li>
        <li><a href="{{ route('direcciones.index') }}">Direcciones</a></li>
        <li><a href="{{ route('centros.index') }}">Centros</a></li>
        <li><a href="{{ route('autorizaciones.index') }}">Autorizaciones</a></li>
        <li><a href="{{ route('autorizacionesMedioambientales.index') }}">Autorizaciones Medioambientales</a></li>
        <li><a href="{{ route('autonomic_communities.index') }}">Comunidades Autónomas</a></li>
        <li><a href="{{ route('wastes.index') }}">Residuos</a></li>
        <li><a href="{{ route('products.index') }}">Productos</a></li>
        <li><a href="{{ route('packages.index') }}">Paquetes</a></li>
    </ul>
</body>
</html>
