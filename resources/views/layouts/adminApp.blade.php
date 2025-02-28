<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Título por defecto')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="..." crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lobster+Two&family=Lora&family=Jost&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('css')
    <style>
        .sidebar-left{
            padding-right: 0 !important;
        }
        #navbarTogglerDemo01{
            position: fixed;
            height: 100%;
            align-items: baseline;
            gap: 20px;
            justify-content: center;
            top: 0px;
            width: inherit;
            left: 0;
        }
        #navbarTogglerDemo01>li{
            width: 100%;
            font-size: 1.45vw;
        }
        #navbarTogglerDemo01>li:hover{
            background-color: rgb(252, 243, 205); 
        }
        #navbarTogglerDemo01>li>a{
            padding-left: 0;
            color: rgb(32, 32, 32);
            font-weight: bold;
        }
        #imgHomeAdmin{
            height: 35px;
            text-align: center;
        }
        #createIcon{
            font-weight: 900;
            font-size: 35px;
            padding-block: 0;
            padding-inline: 15px;
            margin-top: 10px;
        }
        #createIcon>span{
            position: relative;
            bottom: 2px;
        }
        .editButton{
            height: 20px;
            text-align: center;
        }
        .actions{
            display: flex;
            flex-wrap: wrap;
        }
        #tagCategory{
           background-color: rgba(25, 135, 84, 0.7) !important;
        }
        #categoriasLista{
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
        <aside class="sidebar-left">
            <ul class="nav flex-column nav-pills" id="navbarTogglerDemo01">
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link" id="adminHomeLink" href="/admin">
                        <img id="imgHomeAdmin" src="{{ asset('images/house-solid.svg') }}" alt="HOME">
                    </a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($categories) active @endisset" @isset($categories) style="color: white;" @endisset href="/admin">Categories</a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($comments) active @endisset" @isset($comments) style="color: white;" @endisset href="/admin">Comments</a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($contacts) active @endisset" @isset($contacts) style="color: white;" @endisset href="/admin">Contacts</a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($ingredients) active @endisset" @isset($ingredients) style="color: white;" @endisset href="/admin">Ingredients</a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($recipeCategories) active @endisset" @isset($recipeCategories) style="color: white;" @endisset href="/admin">Recipe Categories</a>
                </li>
                <li class="nav-item">
                    <a class="flex-sm-fill text-sm-center nav-link @isset($recipes) active @endisset" @isset($recipes) style="color: white;" @endisset href="/admin/recipe">Recipes</a>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="..." crossorigin="anonymous"></script>
<script refer>
    const adminHomeLink = document.getElementById('adminHomeLink');
    if(window.location.href == adminHomeLink.href){
        adminHomeLink.style.color = 'white';
        adminHomeLink.classList.add('active');
    }
    const descripciones = document.querySelectorAll('.descripcion');
        descripciones.forEach((descripcion) => {
            let descripcionTexto = descripcion.textContent;
            let descripcionAcortada = descripcionTexto.substr(0, 25)+"...";
            descripcion.textContent = descripcionAcortada;
        });
</script>
</html>
