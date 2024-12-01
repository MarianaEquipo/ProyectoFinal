@extends('layouts.plantilla')

@section('nav')
<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ordenar
        </a>
        <ul class="dropdown-menu">
            <li>
                <a href="{{route('ordenar','tituloa')}}">
                 <i class="fa-solid fa-up-long icono-color"></i>   
                </a>
                Título
                <a href="{{route('ordenar','titulod')}}">
                <i class="fa-solid fa-down-long icono-color"></i>   
                </a>
            </li>
            <li>
                <a href="{{route('ordenar','autora')}}">
                 <i class="fa-solid fa-up-long icono-color"></i>   
                </a>
                Autor
                <a href="{{route('ordenar','autord')}}">
                <i class="fa-solid fa-down-long icono-color"></i>   
                </a>
            </li>
            <li>
                <a href="{{route('ordenar','duraciona')}}">
                 <i class="fa-solid fa-up-long icono-color"></i>   
                </a>
                Duración
                <a href="{{route('ordenar','duraciond')}}">
                <i class="fa-solid fa-down-long icono-color"></i>   
                </a>
            </li>
            <li>
                <a href="{{route('ordenar','sinopsisa')}}">
                 <i class="fa-solid fa-up-long icono-color"></i>   
                </a>
                Sinopsis
                <a href="{{route('ordenar','sinopsisd')}}">
                <i class="fa-solid fa-down-long icono-color"></i>   
                </a>
            </li>
            <li>
                <a href="{{route('ordenar','categoriaa')}}">
                 <i class="fa-solid fa-up-long icono-color"></i>   
                </a>
                Categoría
                <a href="{{route('ordenar','categoriad')}}">
                <i class="fa-solid fa-down-long icono-color"></i>   
                </a>
            </li>
        </ul>
    </li>
</ul>
@endsection

@section('contenido')

<div class="contenedor" style="background-image:url('/imagenes/fondo.png'); 
    background-repeat:no-repeat; 
    background-size: cover; 
    background-attachment: fixed; 
    min-height: 100vh; 
    padding-bottom: 50px;">
<br>
    <div>
        <h1 style="color: rgb(231, 225, 217); text-align:center">Film Explorer</h1>
        <h4 style="color: rgb(231, 225, 217); text-align:center">"Bienvenido a Film Explorer"</h4>
    </div>
<br><br>
    <div class="container-fluid" style="width:600px; height:150px;background-color:rgba(240, 224, 224, 0.5);border-radius: 30px">
        <br>
        <form action="{{route('buscar')}}" method="get" class="input-group mb-3" enctype="multipart/form-data">
            <input type="text" name="buscar" class="form-control" placeholder="Buscar" value="{{request('buscar')}}">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </form>
<br>
        <a href="/agregar">
            <button type="button" class="btn btn-primary" style="margin-left:250px">Agregar</button>
        </a>
    </div>

    @if($objetos->isEmpty())
        <div class="alert alert-warning mt-4">
            No existen registros de acuerdo a la búsqueda
        </div>
    @else
        @include('partials.mensaje')

        <div class="container mt-4">
            <h2 class="text-light text-left">Películas</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach($objetos->where('tipo', 'Película') as $pelicula)
                <div class="col">
                    <div class="card h-100" style="width: 100%;" >
                        <img src="/imagenes/{{ $pelicula->portada }}" alt="imagen" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $pelicula->titulo }}</h5>
                            <p class="card-text"><b>Autor:</b> {{ $pelicula->autor }}</p>
                            <p class="card-text"><b>Fecha de Estreno:</b> {{ $pelicula->fecha }}</p>
                            <p class="card-text"><b>Sinopsis:</b> {{ $pelicula->sinopsis }}</p>
                            <p class="card-text"><b>Duración:</b> {{ $pelicula->duracion }}</p>
                            <p class="card-text"><b>Género:</b> {{ $pelicula->genero }}</p>
                            <b><p class="card-text">{{ $pelicula->gusto }} te agradó.</p></b>
                        </div>
                        @if ($pelicula->video)
                        <div class="ratio ratio-16x9">
                            <video controls>
                                <source src="/videos/{{ $pelicula->video }}" type="video/mp4">
                                Tu navegador no admite la reproducción de videos.
                            </video>
                        </div>
                        @endif
                        <div class="card-footer d-flex justify-content-between">
                            @csrf
                            @method('DELETE')
                        
                        
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="fas fa-trash"></i>
                            </button>
                        
                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>¿Seguro/a que quieres eliminar este registro?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        
                        <form action="{{route('borrar',$pelicula->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"> Eliminar</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                            <a href="{{route('editar',$pelicula)}}">
                            <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></i></button>
                            </a>
                        </div>
                    </div>
                </div>
        
                @endforeach
            </div>
        </div>

    
        <div class="container mt-4">
            <h2 class="text-light text-left">Series</h2>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @foreach($objetos->where('tipo', 'Serie') as $serie)
                <div class="col">
                    <div class="card h-100" style="width: 100%;">
                        <img src="/imagenes/{{ $serie->portada }}" alt="imagen" class="card-img-top" style="max-height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ $serie->titulo }}</h5>
                            <p class="card-text"><b>Autor:</b> {{ $serie->autor }}</p>
                            <p class="card-text"><b>Fecha de Estreno:</b> {{ $serie->fecha }}</p>
                            <p class="card-text"><b>Sinopsis:</b> {{ $serie->sinopsis }}</p>
                            <p class="card-text"><b>Duración:</b> {{ $serie->duracion }}</p>
                            <p class="card-text"><b>Género:</b> {{ $serie->genero }}</p>
                            <b><p class="card-text">{{ $serie->gusto }} te agradó.</p></b>
                        </div>
                        @if ($serie->video)
                        <div class="ratio ratio-16x9">
                            <video controls>
                                <source src="/videos/{{ $serie->video }}" type="video/mp4">
                                Tu navegador no admite la reproducción de videos.
                            </video>
                        </div>
                        @endif
                        <div class="card-footer d-flex justify-content-between">
                            @csrf
                            @method('DELETE')
                        
                        
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">
                            <i class="fas fa-trash"></i>
                            </button>
                        
                        <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="confirmModalLabel">Confirma</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <p>¿Seguro/a que quieres eliminar este registro?</p>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        
                        <form action="{{route('borrar',$serie->id)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"> Eliminar</button>
                        </form>
                        </div>
                        </div>
                        </div>
                        </div>
                        
                            <a href="{{route('editar',$serie)}}">
                            <button type="button" class="btn btn-primary"><i class="fa fa-pencil"></i></i></button>
                            </a>
                        </div>
                    </div>
                </div>
                 
                @endforeach
            </div>
        </div>
    @endif

    <div class="d-flex justify-content-center mt-4">
        {{ $objetos->links('pagination::bootstrap-5') }}
    </div>

<x-pie></x-pie>    
</div>

@endsection