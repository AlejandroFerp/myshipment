@extends('layouts.app')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1 class="fw-bold"> Bienvenido a la plataforma de control logístico</h1>
        <p class="text-muted">Selecciona una sección para comenzar</p>
    </div>
    
    <div class="row g-4">
        <div class="col-md-4">
            <a href="{{ route('clientes.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-people fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Clientes</h5>
                        <p class="text-muted">Gestión de clientes y direcciones principales</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('centros.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-building fs-1 text-secondary"></i>
                        <h5 class="card-title mt-3">Centros</h5>
                        <p class="text-muted">Gestión de centros de operaciones</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('wastes.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-recycle fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Residuos</h5>
                        <p class="text-muted">Control y gestión de residuos</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('documentos.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-file-earmark-text fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Documentos</h5>
                        <p class="text-muted">Organiza y consulta tus documentos</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('shipments.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-truck fs-1 text-warning"></i>
                        <h5 class="card-title mt-3">Envíos</h5>
                        <p class="text-muted">Gestiona todos tus envíos fácilmente</p>
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-4">
            <a href="{{ route('recogidas.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-box-seam fs-1 text-info"></i>
                        <h5 class="card-title mt-3">Recogidas</h5>
                        <p class="text-muted">Controla las solicitudes de recogida</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('direcciones.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-geo-alt fs-1 text-danger"></i>
                        <h5 class="card-title mt-3">Direcciones</h5>
                        <p class="text-muted">Administra las direcciones asociadas</p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-4">
            <a href="{{ route('autorizaciones.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-shield-check fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Autorizaciones</h5>
                        <p class="text-muted">Controla las autorizaciones disponibles</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('autorizacionesMedioambientales.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-tree fs-1 text-success"></i>
                        <h5 class="card-title mt-3">Autorizaciones Medioambientales</h5>
                        <p class="text-muted">Permisos relacionados con el medio ambiente</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('autonomic_communities.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-map fs-1 text-primary"></i>
                        <h5 class="card-title mt-3">Comunidades Autónomas</h5>
                        <p class="text-muted">Gestión de regiones y comunidades</p>
                    </div>
                </div>
            </a>
        </div>


        <div class="col-md-4">
            <a href="{{ route('products.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-box fs-1 text-warning"></i>
                        <h5 class="card-title mt-3">Productos</h5>
                        <p class="text-muted">Catálogo de productos disponibles</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('packages.index') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="bi bi-bag fs-1 text-danger"></i>
                        <h5 class="card-title mt-3">Paquetes</h5>
                        <p class="text-muted">Gestión de paquetes y envíos</p>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
