<!DOCTYPE html>
<html lang="es">
<?php
use App\Models\Category;
$categories = Category::all();
?>

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Título por defecto')</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Lora&family=Jost&display=swap"
        rel="stylesheet">
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

            <form action="{{ route('changeLanguage') }}" method="POST">
                @csrf
                <div class="language-select">
                    <select name="language" onchange="this.form.submit()">
                        <option value="es" {{ session('locale') == 'es' ? 'selected' : '' }}>Español</option>
                        <option value="en" {{ session('locale') == 'en' ? 'selected' : '' }}>English</option>
                    </select>
                </div>
            </form>
        </div>
    </header>
    <nav>
        <ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($categories as $category)
                    <li class="nav-item">
                        <a class="nav-link" href="/{{ $category->name }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
            </div>
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
