<?php
if (Session::has('locale')) {
    App::setLocale(Session::get('locale'));
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Título por defecto')</title>
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Lora&family=Jost&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
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
                <input type="text" placeholder="{{ __('messages.SearchRecipes') }}">
                <button class="search-btn">
                    <img src="{{ asset('images/lupa-icon.png') }}" alt="Buscar">
                </button>
            </div>

            <!-- Perfil -->
            <div class="profile">
                @auth
                    <a href="#" class="profile-link">
                        <img src="{{ asset('images/user-icon.png') }}" alt="Perfil">
                        {{ __('messages.MyProfile') }}
                    </a>
                    <div class="dropdown" style="display: none;">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">{{ __('messages.Logout') }}</button>
                        </form>
                    </div>
                @endauth
                @guest
                    <a href="{{ route('login') }}">{{ __('messages.Login') }}</a>
                    <a href="{{ route('register') }}">{{ __('messages.Register') }}</a>
                @endguest
            </div>

            <div class="language-form">
                <form action="{{ route('changeLanguage') }}" method="POST">
                    @csrf
                    <button type="submit" name="language" value="es" class="language-btn">
                        <img src="{{ asset('images/es.png') }}" alt="Español" class="language-flag">
                    </button>
                    <button type="submit" name="language" value="en" class="language-btn">
                        <img src="{{ asset('images/uk.png') }}" alt="English" class="language-flag">
                    </button>
                </form>
            </div>
            </form>
        </div>
    </header>
    <nav>
        <ul>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                @foreach ($categoryList as $category)
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
            <p>{{ __('messages.Contact')}}: contacto@gustoygracia.com</p>
            <p>&copy; 2025 Gusto&Gracia. {{ __('messages.Copyright')}}</p>
        </div>
    </footer>
    @stack('js')
</body>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const profileLink = document.querySelector('.profile-link');
    const dropdown = document.querySelector('.dropdown');

    // Alternar visibilidad del menú desplegable al hacer clic en "My Profile"
    profileLink.addEventListener('click', function(event) {
        event.preventDefault(); // Evitar que el enlace navegue
        dropdown.style.display = (dropdown.style.display === 'block') ? 'none' : 'block';
    });

    // Cerrar el menú si se hace clic fuera de él
    document.addEventListener('click', function(event) {
        if (!profileLink.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = 'none';
        }
    });
});
</script>
</body>

</html>
