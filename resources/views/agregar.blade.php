@extends('layouts.plantilla')

@section('contenido')
<div class="contenedor" style="background-image:url('/imagenes/fondoformu.png'); background-repeat:no-repeat; background-size: cover; height:100vh; background-position:center">

  <form action="{{route('guardar')}}" method="post" enctype="multipart/form-data">
    @csrf
    @if($errors->any())
     <div style="background-color:rgba(252, 111, 111, 0.5);color:antiquewhite">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
     @endif
      <br>

   <div class="container-fluid" style="width:600px; height:800px;background-color:rgba(240, 224, 224, 0.5);border-radius: 50px;">
<br>
    <h3 style="text-align: center">Agrega una nueva serie o película</h3>
    <br>

    <div class="mb-3">
      <label class="form-label">Tipo</label>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="tipo" id="tipoPelicula" value="Película" {{ old('tipo', $objeto->tipo ?? '') == 'Película' ? 'checked' : '' }}>
          <label class="form-check-label" for="tipoPelicula">Película</label>
      </div>
      <div class="form-check">
          <input class="form-check-input" type="radio" name="tipo" id="tipoSerie" value="Serie" {{ old('tipo', $objeto->tipo ?? '') == 'Serie' ? 'checked' : '' }}>
          <label class="form-check-label" for="tipoSerie">Serie</label>
      </div>
  </div>
  
    <div class="mb-3 d-flex align-items-center" >
        <label class="form-label" class="form-label mb-0 me-3">Título</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="titulo" value="{{old('titulo')}}" style="width:150px">
      </div>

      <div class="mb-3 d-flex align-items-center" >
        <label class="form-label" class="form-label mb-0 me-3">Autor/es</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="autor" value="{{old('autor')}}" style="width:150px">
      </div>

      <div class="mb-3 d-flex align-items-center">
      <label class="form-label">Género</label>
      <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="genero" style="width:200px">
        <option value="Romance">Romance</option>
        <option value="Comedia">Comedia</option>
        <option value="Acción">Acción</option>
        <option value="Ciencia Ficción">Ciencia Ficción</option>
        <option value="Terror">Terror</option>
      </select>
      </div>

      <div class="mb-3 d-flex align-items-center">
        <label for="formFile" class="form-label mb-0 me-3">Fecha de estreno</label>
        <input class="form-control" type="date" id="fecha" name="fecha" value="{{old('fecha')}}" style="width:150px">
    </div>

      <div class="mb-3 d-flex align-items-center" >
        <label class="form-label" class="form-label mb-0 me-3">Sinopsis</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="sinopsis" value="{{old('sinopsis')}}" style="width:150px">
      </div>

      <div class="mb-3 d-flex align-items-center" >
        <label class="form-label" class="form-label mb-0 me-3">Duración</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="duracion" value="{{old('duracion')}}" style="width:150px">
      </div>

      <div class="mb-3 d-flex align-items-center">
        <label for="formFile" class="form-label mb-0 me-3">Portada</label>
        <input class="form-control" type="file" id="portada" name="portada">
    </div>

    <div class="mb-3 d-flex align-items-center">
      <label for="formFile" class="form-label mb-0 me-3">Video</label>
      <input class="form-control" type="file" id="video" name="video" accept="video/*">
  </div>

    <label class="form-label">¿Te gustó esta serie?</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="gusto" id="flexRadioDefault1" value="Sí" checked>
      <label class="form-check-label" for="flexRadioDefault1">
        Sí
      </label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="gusto" id="flexRadioDefault2" value="No">
      <label class="form-check-label" for="flexRadioDefault2">
        No
      </label>
    </div>

    <button type="submit" class="btn btn-primary" style="margin-left:250px">Guardar</button><br>
<br>
<br>
  </form>
@endsection
