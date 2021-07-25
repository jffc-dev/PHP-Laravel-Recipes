<?php

namespace App\Http\Controllers;

use App\Perfil;
use App\Receta;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['show']);
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Perfil $perfil)
    {
        //Obtener las recetas con paginación
        $recetas = Receta::where('user_id',auth()->id())->paginate(3);
        return view('perfiles.show')->with('perfil', $perfil)->with('recetas',$recetas);
    }

    public function edit(Perfil $perfil)
    {
        $this->authorize('view', $perfil);
        return view('perfiles.edit')->with('perfil', $perfil);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perfil $perfil)
    {  
        //Ejecutar policy
        $this->authorize('update', $perfil);
        //Validar datos ingresados
        $data = request()->validate([
            'nombre' => 'required',
            'url' => 'required',
            'biografia' => 'required'
        ]);

        //Si se sube una imagen

        if($request["imagen"]){
            $ruta_imagen = $request['imagen']->store('upload-perfiles', 'public');

            //Resize de la imagen, usando la librería intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(600, 600);
            $img->save();
            $array_imagen = ['imagen' => $ruta_imagen];
        }
        
        //Asignar nombre y url
        
        auth()->user()->url = $data['url'];
        auth()->user()->name = $data['nombre'];
        auth()->user()->save();

        // $perfil->usuario->url = $data['url'];
        // $perfil->usuario->name = $data['nombre'];
        // $perfil->usuario->save();

        //Asignar biografia e imagen
        // auth()->user()->perfil()->update([
        //     "biografia" => $data["biografia"]
        // ]);
        unset($data['url']);
        unset($data['nombre']);
        auth()->user()->perfil()->update(
            array_merge($data, $array_imagen ?? [])
        );

        //Guardar datos

        //Redireccionar
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perfil  $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perfil $perfil)
    {
        //
    }
}
