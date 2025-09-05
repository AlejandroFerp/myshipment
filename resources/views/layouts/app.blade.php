<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShipment</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons (opcional, para usar iconos) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- layouts/app.blade.php -->
    <style>
        /* Fuente base y fondo claro */
        body {
            background-color: #f8f9fa;
            font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            line-height: 1.6;
        }

        /* Espaciado inferior para que el contenido no quede pegado */
        main.container {
            padding-bottom: 4rem;
        }

        /* Títulos principales */
        h1, h2, h3 {
            font-weight: 700;
            color: #343a40;
        }

        /* Navbar más elegante */
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        /* Estilos de cards */
        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: none;
            border-radius: 1rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
        }

        .card-body i {
            display: block;
            margin-bottom: 0.5rem;
        }

        /* Links de cards */
        a.text-decoration-none {
            color: inherit;
        }
        a.text-decoration-none:hover {
            text-decoration: none;
        }

        /* Footer opcional */
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem;
            text-align: center;
            margin-top: 2rem;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">MyShipment</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ route('clientes.index') }}" class="nav-link">Clientes</a></li>
                    <li class="nav-item"><a href="{{ route('centros.index') }}" class="nav-link">Centros</a></li>
                    <li class="nav-item"><a href="{{ route('shipments.index') }}" class="nav-link">Envíos</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        @yield('content')
    </main>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @yield('scripts')
</body>
</html>

