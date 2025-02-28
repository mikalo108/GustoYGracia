@extends('layouts.adminApp')

@push('css')
    <!-- estilos adicionales -->
    <style>
        .container{
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: auto;
            gap: 30px;
        }
        .container>div{
            -webkit-user-drag: none;
            user-select: none;
        }
        .container>div:hover{
            background-color: #f0f0f0;
            cursor:pointer;
        }
    </style>
@endpush

@section('title', 'Home')

@section('content')
    <h1>Admin Home</h1>  
    <hr>
    <div class="container">
        <div class="card text-bg-ligth" link="/admin/recipe">
            <div class="card-body">
                <h5 class="card-title">Recetas</h5>
                <p class="card-text">Aquí se gestionan las recetas</p>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        const secciones = document.querySelectorAll('.card');
        secciones.forEach(seccion => {
            seccion.addEventListener('click', () => {
                window.location.href = seccion.getAttribute('link');
            });
        });
    })
</script>
