<x-guest-layout>
    <head>
        <title>StockEase - Iniciar Sesión</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
        <link rel="icon" href="/assents/logo/LogoStockEase.svg" />

        <style>
            /* Estilos personalizados para el formulario */
            body {
                background: linear-gradient(to top, #f3f4f6, #ffffff);
                font-family: "Arial", sans-serif;
                color: #333;
            }

            .card {
                background: #fff;
                border: none;
            }

            /* Título principal */
            h1 {
                color: #7e57c2;
                font-weight: bold;
            }

            /* Inputs */
            .form-control {
                border-radius: 10px;
                border: 1px solid #ccc;
            }

            /* Botones */
            .btn-primary {
                background-color: #7e57c2;
                border: none;
            }

            .btn-primary:hover {
                background-color: #5e3fa4;
            }

            .btn-outline-primary {
                color: #7e57c2;
                border-color: #7e57c2;
            }

            .btn-outline-primary:hover {
                background-color: #7e57c2;
                color: #fff;
            }

            /* Enlace de contraseña olvidada */
            .text-muted {
                font-size: 0.9rem;
            }
        </style>
    </head>

    <body>
        <div class="container d-flex justify-content-center align-items-center vh-100">
            <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px; border-radius: 20px">

                <h1 class="text-center mb-4" style="color: #7e57c2; font-weight: bold;">StockEase</h1>

                <!-- Formulario -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Correo Electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope"></i> Correo Electrónico
                        </label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ingresa tu correo electrónico" value="{{ old('email') }}" required autofocus />
                        @error('email')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            <i class="fas fa-lock"></i> Contraseña
                        </label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Ingresa tu contraseña" required />
                        @error('password')
                            <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Recordarme -->
                    <div class="form-check mb-3">
                        <input type="checkbox" id="remember_me" name="remember" class="form-check-input" />
                        <label for="remember_me" class="form-check-label">Recuérdame</label>
                    </div>

                    <!-- Botón Iniciar Sesión -->
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary w-100 py-2" style="border-radius: 50px">Inicia sesión</button>
                    </div>

                    <!-- Enlace de contraseña olvidada -->
                    @if (Route::has('password.request'))
                        <div class="text-center">
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">¿Olvidaste tu contraseña?</a>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</x-guest-layout>
