<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - StockEasy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* 🔹 Estilos generales */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* 🔹 Navbar (visible en móviles) */
        .navbar {
            background-color: #6f42c1;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }

        /* 🔹 Botón del menú hamburguesa */
        .navbar-toggler {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* 🔹 Sidebar */
        .sidebar {
            width: 250px;
            height: 100vh;
            background-color: #6f42c1;
            position: fixed;
            top: 0;
            left: -250px;
            padding-top: 70px;
            z-index: 999;
            transition: left 0.3s;
        }

        .sidebar.show {
            left: 0;
        }

        .sidebar h4 {
            color: white;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar .nav-link {
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            display: block;
        }

        .sidebar .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        /* 🔹 Contenido Principal */
        .content {
            margin-left: 250px;
            padding: 20px;
            padding-top: 70px;
            transition: margin-left 0.3s;
            width: calc(100% - 250px);
        }

        /* 🔹 Responsividad */
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
                width: 100%;
            }
        }

        @media (min-width: 769px) {
            .navbar {
                display: none; /* Ocultar navbar en escritorio */
            }

            .sidebar {
                left: 0; /* Sidebar siempre visible en escritorio */
            }

            .content {
                margin-left: 250px;
                width: calc(100% - 250px);
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar">
        <button class="navbar-toggler" id="menu-toggle">&#9776;</button>
        <a class="navbar-brand text-white" href="{{ route('admin.dashboard') }}">StockEasy - Admin</a>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <h4>Menú</h4>
        <a href="{{ route('admin.dashboard') }}" class="nav-link">Dashboard</a>
        <a href="{{ route('admin.usuarios.index') }}" class="nav-link">Usuarios</a>
        <a href="{{ route('admin.productos.index') }}" class="nav-link">Productos</a>
        <a href="{{ route('admin.proveedores.index') }}" class="nav-link">Proveedores</a>
        <a href="{{ route('admin.ventas') }}" class="nav-link">Ventas</a>
        <a href="{{ route('logout') }}" class="nav-link"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

    <!-- Contenido Principal -->
    <div class="content">
        <div class="logo-container">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo-inventario">
        </div>
        @yield('content')
    </div>

    <script>
        document.getElementById("menu-toggle").addEventListener("click", function() {
            document.getElementById("sidebar").classList.toggle("show");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

