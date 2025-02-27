<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Título por defecto')</title>
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

            <!-- Buscador -->
            <div class="search-bar">
                <input type="text" placeholder="Buscar recetas...">
                <button class="search-btn">
                    <img src="{{ asset('images/lupa-icon.png') }}" alt="Buscar">
                </button>
            </div>

            <!-- Perfil -->
            <div class="profile">
                <a href="/perfil">
                    <img src="{{ asset('images/user-icon.png') }}" alt="Perfil">
                    Mi Perfil
                </a>
            </div>
        </div>
    </header>
    <nav>
        <ul>
            <li><a href="/postres">Postres</a></li>
            <li><a href="/pastas">Pastas</a></li>
            <li><a href="/ensaladas">Ensaladas</a></li>
            <li><a href="/sopas">Sopas</a></li>
            <li><a href="/bebidas">Bebidas</a></li>
        </ul>
    </nav>
    <section class="content-container">
        <aside class="sidebar-left"></aside>
        
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

</html>
