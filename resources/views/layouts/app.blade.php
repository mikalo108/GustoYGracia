@php
    if (Session::has('locale')) {
        App::setLocale(Session::get('locale'));
    } else {
        App::setLocale(config('app.locale'));
    }
@endphp

@if (Auth::check() && Auth::user()->email === 'admin@gustoygracia.com')
    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="utf-8" />
        <title>@yield('title', 'Título por defecto')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="..." crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Lora&family=Jost&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
        @stack('css')
        <style>
            .sidebar-left {
                padding-right: 0 !important;
            }
            
            #navbarTogglerDemo01 {
                position: fixed;
                height: 100%;
                align-items: baseline;
                gap: 20px;
                justify-content: center;
                top: 0px;
                width: inherit;
                left: 0;
            }

            #navbarTogglerDemo01>li {
                width: 100%;
                font-size: 1.45vw;
            }

            #navbarTogglerDemo01>li:hover {
                background-color: rgb(252, 243, 205);
            }

            #navbarTogglerDemo01>li>a {
                padding-left: 0;
                color: rgb(32, 32, 32);
                font-weight: bold;
            }

            #imgHomeAdmin {
                height: 35px;
                text-align: center;
            }

            #createIcon {
                font-weight: 900;
                font-size: 35px;
                padding-block: 0;
                padding-inline: 15px;
                margin-top: 10px;
            }

            #createIcon>span {
                position: relative;
                bottom: 2px;
            }

            .editButton {
                height: 20px;
                text-align: center;
            }

            .actions {
                display: flex;
                flex-wrap: wrap;
            }

            #tagCategory {
                background-color: rgba(25, 135, 84, 0.7) !important;
            }

            #categoriasLista {
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
            }
        </style>
    </head>

    <body>
        <header>
            <div class="header-container">
                <!-- Logo -->
                <div class="logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo de Recetario">
                </div>
                <!-- Buscador -->
                <div class="search-bar" style="visibility: hidden;">
                    <input type="text" placeholder="{{ __('messages.SearchRecipes') }}">
                    <button class="search-btn">
                        <img src="{{ asset('images/lupa-icon.png') }}" alt="Buscar">
                    </button>
                </div>
                <!-- Perfil -->
                <div class="profile">
                    <a href="#" class="profile-link">
                        <img src="{{ asset('images/user-icon.png') }}" alt="Perfil">
                        ADMIN
                    </a>
                    <div class="dropdown" style="display: none;">
                        <a href="{{ route('myprofile') }}">Mi perfil</a>
                        <hr style="color: black; margin-block:10px">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">{{ __('messages.Logout') }}</button>
                        </form>
                    </div>
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
        <section class="content-container">
            <aside class="sidebar-left">
                <ul class="nav flex-column nav-pills" id="navbarTogglerDemo01">
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link" id="adminHomeLink" href="{{ route('home') }}">
                            <img id="imgHomeAdmin" src="{{ asset('images/house-solid.svg') }}" alt="HOME">
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($categories) active @endisset"
                            @isset($categories) style="color: white;" @endisset
                            href="{{ route('home') }}">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($comments) active @endisset"
                            @isset($comments) style="color: white;" @endisset
                            href="{{ route('home') }}">Comments</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($contacts) active @endisset"
                            @isset($contacts) style="color: white;" @endisset
                            href="{{ route('home') }}">Contacts</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($ingredients) active @endisset"
                            @isset($ingredients) style="color: white;" @endisset
                            href="{{ route('home') }}">Ingredients</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($recipeCategories) active @endisset"
                            @isset($recipeCategories) style="color: white;" @endisset
                            href="{{ route('home') }}">Recipe
                            Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($recipes) active @endisset"
                            @isset($recipes) style="color: white;" @endisset
                            href="{{ route('recipe.index') }}">Recipes</a>
                    </li>
                </ul>
            </aside>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..."
        crossorigin="anonymous"></script>
    <script refer>
        const adminHomeLink = document.getElementById('adminHomeLink');
        if (window.location.href == adminHomeLink.href) {
            adminHomeLink.style.color = 'white';
            adminHomeLink.classList.add('active');
        }
        const descripciones = document.querySelectorAll('.descripcion');
        descripciones.forEach((descripcion) => {
            let descripcionTexto = descripcion.textContent;
            let descripcionAcortada = descripcionTexto.substr(0, 25) + "...";
            descripcion.textContent = descripcionAcortada;
        });
    </script>

    </html>
@else
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
                            <a href="{{ route('myprofile') }}">Mi perfil</a>
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
                <p>{{ __('messages.Contact') }}: contacto@gustoygracia.com</p>
                <p>&copy; 2025 Gusto&Gracia. {{ __('messages.Copyright') }}</p>
            </div>
        </footer>
        @stack('js')
    </body>

    </html>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
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
