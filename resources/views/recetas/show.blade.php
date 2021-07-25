@extends('layouts.app')

@section('content')
    <article class="contenido-receta bg-white p-5 shadow">
        <h1 class="text-center mb-4">{{$receta->titulo}}</h1>

        <div class="imagen-receta">
            <img src="/storage/{{ $receta->imagen }}" alt="Imagen de la receta" class="w-100">
        </div>

        <div class="receta-meta mt-3">
            <p>
                <span class="font-weight-bold text-primary">Escrito en: </span>
                <a class="text-dark" href="{{route('categorias.show',['categoriaReceta' => $receta->categoria_id])}}">{{$receta->categoria->nombre}}</a>
            </p>

            <p>
                <span class="font-weight-bold text-primary">Autor: </span>
                <a class="text-dark" href="{{route('perfiles.show',['perfil' => $receta->autor->id])}}">{{$receta->autor->name}}</a>
            </p>

            <p>
                <span class="font-weight-bold text-primary">Fecha: </span>
                @php
                    $fecha = $receta->created_at
                @endphp

                <fecha-receta fecha="{{$fecha}}"></fecha-receta>
            </p>

            <div class="ingredientes" style="overflow: hidden; text-overflow: ellipsis;">
                <h2 class="my-3 text-primary">Ingredientes</h2>
                {!! $receta->ingredientes !!}
            </div>

            <div class="preparacion" style="overflow: hidden; text-overflow: ellipsis;">
                <h2 class="my-3 text-primary">Preparación</h2>
                {!! $receta->preparacion !!}
            </div>

            <div class="justify-content-center row text-center">
                <like-button
                    receta-id="{{$receta->id}}"
                    like="{{$like}}"
                    likes="{{$likes}}"
                ></like-button>
            </div>
            
        </div>

        <div >
            <form action="{{route('comments.store',['receta' => $receta->id])}}" method="post" novalidate >
                @csrf
                <div class="form-group">
                    <label for="contenido">Comenta esta receta</label>
                    <input type="text" name="contenido" class="form-control @error('contenido') is-invalid @enderror" id="contenido" placeholder="Tu comentario ..." value={{ old('contenido') }}>

                    @error('contenido')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" value="Comentar" class="btn btn-primary">
                </div>
            </form>
        </div>
    </article>
    <div style="padding: 2rem; margin-top: 2rem" class="bg-white shadow">
        <h2 class="my-3 mb-5 text-primary">Comentarios <span class="text-secondary">({{$cant_comentarios}})</span></h2>
        @foreach($comentarios as $comentario)
            <div class="row mb-5">
                <div class="col-2">
                    @if($comentario->autor->perfil->imagen == "")
                        <img src="{{asset('images/user-default.jpg')}}" class="img-fluid rounded-circle" alt="Image">
                    @else
                        <img src="/storage/{{ $comentario->autor->perfil->imagen }}" class="img-fluid rounded-circle" alt="Image">
                    @endif
                </div>
                <div class="col-10">
                    @php
                        $fecha_com = $comentario->created_at
                    @endphp

                    <h3 class="mb-3"><a class="text-dark" href="{{route('perfiles.show',['perfil'=>$comentario->autor->id])}}">{{$comentario->autor->name}}</a><small> comentó el <span class="text-primary fecha font-weight-bold"><fecha-receta fecha="{{$fecha_com}}"></fecha-receta></span></small></h3>
                    {{$comentario->contenido}}
                </div>
            </div>
        @endforeach
        @if($cant_comentarios > 3)
            <div class="justify-content-center row text-center">
                <a href="#" class="btn btn-primary font-weight-bold p-3">Ver todos</a>
            </div>
        @endif
    </div>
    
@endsection