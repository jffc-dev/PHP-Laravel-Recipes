@extends('layouts.app')

@section('botones')
    @include('ui.navegacion')
@endsection

@section('content')
    <h2 class="text-center mb-5">Administrar recetas</h2>
    
    <div class="col-md-10 mx-auto">
        <table class="table bg-white p-3">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">Titulo</th>
                    <th scole="col">Categoria</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recetas as $receta)
                    <tr>
                        <td>{{$receta->titulo}}</td>
                        <td>{{$receta->categoria->nombre}}</td>
                        <td>
                            <a href="{{route('recetas.edit', ['receta'=>$receta->id])}}" class="btn btn-dark mr-1">Editar</a>

                            <a href="{{route('recetas.show', ['receta' => $receta->id ])}}" class="btn btn-success mr-1">Ver</a>

                            {{-- <form action="{{route('recetas.destroy', ['receta' => $receta->id ])}}" class="d-inline" method="POST">
                                @method('delete')
                                @csrf
                                <input type="submit" value="Eliminar ×" class="btn btn-danger mr-1">
                            </form> --}}

                            <eliminar-receta receta-id={{$receta->id}}></eliminar-receta>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="col-12 mt-4 justify-content-center d-flex">
            {{$recetas->links()}}
        </div>

        <h2 class="text-center my-5">Recetas que te gustan</h2>

        <div class="col-md-10 mx-auto bg-white p-3">
            <ul class="list-group">
                @foreach( Auth::user()->meGusta as $receta)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <p>{{$receta->titulo}}</p>
                        <a href="{{route('recetas.show', ['receta' => $receta->id])}}" class="btn btn-outline-success">Ver receta</a>
                    </li>
                @endforeach
                @if(count(Auth::user()->meGusta) === 0)
                    <p class="text-center">No tienes recetas guardadas<small>(Agrega una receta a tus favoritas y se mostrará aquí)<small></p>
                @endif
            </ul>
        </div>
    </div>
@endsection
