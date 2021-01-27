@extends('base')
@section('title') Inicio @endsection
@section('content')
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Barra de navegación</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('post.create')}}">+Nuevo</a>
          </li>
        </ul>
        <form action= "{{route('post.search')}}" method=POST class="d-flex">
            {{csrf_field()}}
          <input class="form-control me-2" type="text" name="search" placeholder="Buscar" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
      </div>
    </div>
  </nav>
    <table class="table">
        <thead>
            <tr>
                <th>{{ "ID" }}</th>
                <th>{{"IMAGEN"}}</th>
                <th>{{ "TITLE" }}</th>
                <th>{{ "AUTHOR" }}</th>
                <th>{{ "ACCIONES" }}</th>
            </tr>
        </thead>
        <tbody>
            @if (count($posts) >= 1)
            @foreach ($posts as $post)
                <tr>
                    <td scope="row"> {{ $post ->id}} </td>
                    <td scope="row"> >img src="{{ asset('storage').'/'.$post->image }}" alt="" width="100"</td>
                    <td> {{ $post -> image }} </td>
                    <td> {{ $post -> author }} </td>
                    <td>
                        <a href ="{{ route("post.edit", $post ->id )}}"class="btn btn-sm btn-danger"> EDITAR </a>
                        <form action="{{route("post.destroy", $post->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('¿Realmente desea eliminar este registro?')" >Eliminar</button>
                        </form>
                    </td>
            @endforeach
            @else
                <tr>
                    <td scope="row"> {{"no encontro resultados"}} </td>
                </tr>
             @endif
        </tbody>
    </table>
@endsection
