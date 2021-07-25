@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if($perfil->imagen)
                    <img src="/storage/{{$perfil->imagen}}" alt="Imagen de perfil" class="w-100 rounded-circle">
                @else
                    <img src="{{asset('images/user-default.jpg')}}" class="img-fluid rounded-circle" alt="Image" style="border: solid 5px #ED4646">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2 text-primary font-weight-bold">
                    {{$perfil->usuario->name}}
                </h2>
                <a href="{{$perfil->usuario->url}}">Visitar página</a>
                <div class="biografia text-justify">
                    {!! $perfil->biografia !!}
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Recetas creadas por: {{$perfil->usuario->name}}</h2>
    <div class="container">
        <div class="row mx-auto bq-white p-4">
            @forelse($recetas as $receta)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="/storage/{{$receta->imagen}}" class="card-img-top" alt="Imagen de receta">
                        <div class="card-body">
                            <h3 class="text-center">{{$receta->titulo}}</h3>
                            <a href="{{route('recetas.show',['receta' => $receta->id])}}" class="btn btn-primary d-block mt-4 text-uppercase">Ver receta</a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center w-100">Este usuario aún no ha creado recetas</p>
            @endforelse
        </div>
        @if(count($recetas) > 0)
            <div class="d-flex justify-content-center">
                {{$recetas->links()}}
            </div>
        @endif
    </div>
@endsection