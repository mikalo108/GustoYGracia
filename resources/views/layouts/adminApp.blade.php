<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Título por defecto')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Lora&family=Jost&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
</head>

<body>
    <header>
        <div class="header-container">
            <!-- Logo -->
            <div class="logo">
                <img src="{{ asset('images/logo.png') }}" alt="Logo de Recetario">
            </div>

            <!-- Perfil -->
            <div class="profile">
                <a>
                    <img src="{{ asset('images/user-icon.png') }}" alt="Perfil">
                    ADMIN
                </a>
            </div>
        </div>
    </header>
    <section class="content-container">
        <aside class="sidebar-left"></aside>
            <div class="navbar">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></spa>
                </button>
                <ul class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Hola</a>
                    </li>
                </ul>
            </div>
        <main class="main-content">
            @yield('content')
        </main>
        
        <aside class="sidebar-right"></aside>
    </section>
    <footer>
        <div class="footer-container">
            <p>Contacto: ejemplo@recetario.com</p>
            <p>&copy; 2025 Recetario. Todos los derechos reservados.</p>
        </div>
    </footer>
    @stack('js')
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
</html>
