@extends('layouts.app')

@section('botones')
    @include('ui.administrador')
@endsection

@section('content')
    <h2 class="text-center mb-5">Administrar recetas</h2>
    
    <div class="col-md-10 mx-auto">
        <table class="table bg-white p-3">
            <thead class="bg-primary text-light">
                <tr>
                    <th scole="col">#</th>
                    <th scole="col">Nombre</th>
                    <th scole="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $cont = 1;
                @endphp
                @foreach($categorias as $categoria)
                    <tr>
                        <td>{{$cont}}</td>
                        <td>{{$categoria->nombre}}</td>
                        <td>
                            <a href="{{route('categorias.edit', ['categoria'=>$categoria->id])}}" class="btn btn-dark mr-1">Editar</a>
                            <eliminar-categoria categoria-id={{$categoria->id}}></eliminar-categoria>
                        </td>
                    </tr>
                    @php
                        $cont++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>
@endsection