<div class="col-md-4 mt-4">
    <div class="card shadow">
        <img class="card-img-top" src="/storage/{{ $receta->imagen }}" alt="Imagen receta">
        <div class="card-body">
            <h3 class="card-title text-center">{{$receta->titulo}}</h3>

            <div class="meta-receta d-flex justify-content-between">
                @php
                    $fecha = $receta->created_at
                @endphp
                <p class="text-primary fecha font-weight-bold">
                    <fecha-receta fecha="{{$fecha}}"></fecha-receta>
                </p>
                
                <p>A {{count($receta->likes)}} les gustó</p>
            </div>

            <p class="text-justify card-text">{{ Str::words(strip_tags($receta->preparacion), 25) }}</p>
            <a href="{{route('recetas.show',['receta'=>$receta->id])}}" class="btn btn-primary d-block font-weight-bold text-uppercase btn-receta">Ver Receta</a>
            
        </div>
    </div>
</div>