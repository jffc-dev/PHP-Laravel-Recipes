@extends('layouts.app')

@section('botones')
    @include('ui.administrador')
@endsection

@section('content')
    <h2 class="text-center mb-5">Editar categoria</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{route('categorias.update',['categoria' => $categoria->id])}}" method="post" class="bg-white" novalidate style="padding: 2rem; border-radius: 1rem;">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="nombre">Nombre categoria: </label>
                    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" id="nombre" placeholder="Nombre de la nueva categoría..." value="{{ $categoria->nombre }}">

                    @error('nombre')
                        <span class="invalid-feedback d-block" role="alert">
                            <strong>{{$message}}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="Guardar cambios" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection