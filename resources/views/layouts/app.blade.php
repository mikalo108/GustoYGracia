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
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
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

            #createIcon>img {
                position: relative;
                bottom: 2px;
            }

            .editButton {
                height: 20px;
                text-align: center;
            }

            .actions {
                display: grid;
                width: 100%;
                grid-template-columns: 1fr 1fr;
                grid-template-rows: 1fr;
                column-gap: 2.5px;
            }

            .actions>.btn {
                padding: 0;
            }

            #tagCategory {
                background-color: rgba(25, 135, 84, 0.7) !important;
            }

            #categoriasLista {
                display: flex;
                flex-direction: column;
                flex-wrap: wrap;
            }

            .search-form {
                display: grid;
                text-align: left;
                grid-template-columns: 1fr 1fr;
                row-gap: 10px;
                column-gap: 20px;
            }

            .search-form>#botonBuscar {
                width: 65px;
                margin: 0;
            }

            .filaTablaIndex:hover>td {
                background-color: rgba(222, 226, 230, 0.6);
            }
        </style>
    </head>

    <body>
        <header>
            <div class="header-container">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo de Recetario">
                    </a>
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
                        <button class="myprofile-btn">
                            <a href="{{ route('myProfile') }}">{{ __('messages.MyProfile') }}</a>
                        </button>
                        <hr style="color: black; margin-block:10px">
                        <form action="{{ route('logout') }}" method="POST" class="logout-form">
                            @csrf
                            <button type="submit" class="logout-btn">{{ __('messages.Logout') }}</button>
                        </form>
                    </div>
                </div>

                <!-- Selector idioma -->
                <div class="language-form">
                    <form action="{{ route('changeLanguage') }}" method="POST">
                        @csrf
                        <button type="submit" name="language" value="es"
                            class="language-btn @if (__('auth.lang') == 'es') languageSelected @endif">
                            <img src="{{ asset('images/es.png') }}" alt="Español" class="language-flag">
                        </button>
                        <button type="submit" name="language" value="en"
                            class="language-btn @if (__('auth.lang') == 'en') languageSelected @endif">
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
                        <a id="recetaLink" class="flex-sm-fill text-sm-center nav-link"
                            href="{{ route('recipe.index') }}">{{ __('admin.TitleRecipesTable') }}</a>
                    </li>
                    <li class="nav-item">
                        <a id="categoriaLink" class="flex-sm-fill text-sm-center nav-link"
                            href="{{ route('category.index') }}">{{ __('admin.TitleCategoriesTable') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($ingredientList) active @endisset"
                            @isset($ingredientList) style="color: white;" @endisset
                            href="{{ route('ingredient.index') }}">{{ __('admin.TitleIngredientsTable') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($userList) active @endisset"
                            @isset($userList) style="color: white;" @endisset
                            href="{{ route('user.index') }}">{{ __('admin.TitleUsersTable') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($contactList) active @endisset"
                            @isset($contactList) style="color: white;" @endisset
                            href="{{ route('contact.index') }}">{{ __('admin.TitleContactsTable') }}</a>
                    </li>

                    <li class="nav-item">
                        <a class="flex-sm-fill text-sm-center nav-link @isset($commentList) active @endisset"
                            @isset($commentList) style="color: white;" @endisset
                            href="{{ route('comment.index') }}">{{ __('admin.TitleCommentsTable') }}</a>
                    </li>


                </ul>
            </aside>

            <main class="main-content">
                @yield('content')
            </main>

            <aside class="sidebar-right"></aside>
        </section>
        <footer class="navOscuro">
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
        // Detectar en cual vista nos encontramos y mostrarlo con la clase active de bootstrap.
        const adminHomeLink = document.getElementById('adminHomeLink');
        if (window.location.href == adminHomeLink.href) {
            adminHomeLink.style.color = 'white';
            adminHomeLink.classList.add('active');
        }

        // Acortamos las descripciones en el index.
        const descripciones = document.querySelectorAll('.descripcion');
        descripciones.forEach((descripcion) => {
            let descripcionTexto = descripcion.textContent;
            let descripcionAcortada = descripcionTexto.substr(0, 25) + "...";
            descripcion.textContent = descripcionAcortada;
        });

        // Capturamos el evento de borrado del formulario.
        let botonesBorrar = document.querySelectorAll(".botonBorrar");
        botonesBorrar.forEach((botonBorrar) => {
            botonBorrar.addEventListener("click", () => {
                botonBorrar.parentElement.submit();
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            let location = window.location.href.split("/");
            const linkReceta = document.getElementById("recetaLink");
            const linkCategoria = document.getElementById("categoriaLink");
            if (location.includes("category")) {
                linkCategoria.style.color = 'white';
                linkCategoria.classList.add('active');
            } else if (location.includes("recipe")) {
                linkReceta.style.color = 'white';
                linkReceta.classList.add('active');
            }
        })

        let filasTablaIndex = document.querySelectorAll(".filaTablaIndex");
        filasTablaIndex.forEach(fila => {
            fila.addEventListener("dblclick", () => {
                window.location.href = fila.getAttribute('link');
            })
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
        <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
        @stack('css')
    </head>

    <body>
        <header>
            <div class="header-container">
                <!-- Logo -->
                <div class="logo">
                    <a href="{{ route('home') }}">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo de Recetario">
                    </a>
                </div>
                
                <!-- Buscador -->
                <div class="search-bar">
                    <form action="{{ route('recipe.userSearch') }}" method="GET">
                        <input type="text" name="query" placeholder="{{ __('messages.SearchRecipes') }}"
                            value="{{ request('query') }}">
                        <button type="submit" class="search-btn">
                            <img src="{{ asset('images/lupa-icon-solid-white.svg') }}" alt="Buscar">
                        </button>
                    </form>
                </div>

                <!-- Perfil -->
                <div class="profile">
                    @auth
                        <button id="app-profile-btn">
                            <a href="#" class="profile-link">
                                <span><img src="{{ asset('images/user-icon.png') }}" alt="Perfil"></span>
                                <span id="user-name">{{ Auth::user()->name }}</span>

                            </a>
                        </button>

                        <div class="dropdown" style="display: none;">
                            <button class="myprofile-btn">
                                <a href="{{ route('myProfile') }}">{{ __('messages.EditProfile') }}</a>
                            </button>
                            <button class="myprofile-btn">
                                <a href="{{ route('myRecipes', Auth::user()) }}">{{ __('messages.MyRecipes') }}</a>
                            </button>
                            <hr style="color: black; margin-block:10px">
                            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                                @csrf
                                <button type="submit" class="logout-btn">{{ __('messages.Logout') }}</button>
                            </form>
                        </div>
                    @endauth
                    @guest
                        <div id="home-buttons">
                            <button>
                                <a href="{{ route('login') }}" id="login-link">{{ __('messages.Login') }}</a>
                            </button>
                            <br>
                            <button>
                                <a href="{{ route('register') }}" id="signup-link">{{ __('messages.Register') }}</a>
                            </button>
                        </div>
                    @endguest
                </div>

                <div class="language-form">
                    <form action="{{ route('changeLanguage') }}" method="POST">
                        @csrf
                        <button type="submit" name="language" value="es"
                            class="language-btn @if (__('auth.lang') == 'es') languageSelected @endif">
                            <img src="{{ asset('images/es.png') }}" alt="Español" class="language-flag">
                        </button>
                        <button type="submit" name="language" value="en"
                            class="language-btn @if (__('auth.lang') == 'en') languageSelected @endif">
                            <img src="{{ asset('images/uk.png') }}" alt="English" class="language-flag">
                        </button>
                    </form>
                </div>
                </form>
            </div>
        </header>
        <nav>
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 navOscuro">
                @foreach ($categoryList as $category)
                    <li class="nav-item">
                        <a class="nav-link"
                            href="{{ route('showByCategory', $category->id) }}">{{ $category->name }}</a>
                    </li>
                @endforeach
            </ul>
        </nav>
        <section class="content-container">
            <aside class="sidebar-left"></aside>

            <main class="main-content">
                @yield('content')
            </main>

            <aside class="sidebar-right"></aside>
        </section>
        <footer class="navOscuro">
            <div class="footer-container">
                <p>{{ __('messages.Contact') }}: contacto@gustoygracia.com</p>
                <p>&copy; 2025 Gusto&Gracia. {{ __('messages.Copyright') }}</p>
            </div>
        </footer>
        @stack('js')
    </body>

    </html>
@endif

@stack('scripts')
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

        // Vaciar campos busquedas y redireccionar al index
        const formBusqueda = document.getElementById("formBusqueda");
        const vaciarCampos = document.getElementById("vaciarCampos");
        if(vaciarCampos){
            vaciarCampos.addEventListener("click", ()=>{
                window.location.href=formBusqueda.getAttribute("action");
            })
        }

        if(formBusqueda){
            formBusqueda.addEventListener("input", () => {            
                let campos = formBusqueda.querySelectorAll("input[type='text']");
                // Comprobar si todos los campos están vacíos
                let todosVacios = true;
                campos.forEach((campo) => {
                    if (campo.value.trim() !== "") {
                        todosVacios = false;  // Si al menos un campo tiene contenido, no todos están vacíos
                    }
                });

                // Mostrar u ocultar el botón de vaciar campos basado en el estado de los campos
                if (todosVacios) {
                    window.location.href=formBusqueda.getAttribute("action");
                } else {
                    vaciarCampos.style.visibility = 'visible';  // Mostrar el botón si hay al menos un campo con contenido
                }
            });
        }

        // Si los campos de búsqueda del index son impares, aplicamos un estilo.
        if(formBusqueda){
            let campos = formBusqueda.querySelectorAll("input[type='text']");
            if((campos.length%=2)==1){
                let botonBuscar= document.getElementById("botonBuscar");
                botonBuscar.style.gridColumn="1/1";
            }
        }

    });
</script>