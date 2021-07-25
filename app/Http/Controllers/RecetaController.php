<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class RecetaController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('show','search');
    }

    public function index()
    {
        // $recetas = Auth::user()->recetas;
        $recetas = Receta::where('user_id',auth()->id())->paginate(5);
        return view('recetas.index')->with('recetas',$recetas);
    }

    public function create()
    {
        //Obtener categorias sin modelo
        $categorias = DB::table('categoria_recetas')->get()->pluck('nombre','id');
        //Obtener categorias con modelo
        $categorias = CategoriaReceta::all(['id', 'nombre']);
        return view('recetas.create')->with('categorias',$categorias);
    }

    public function store(Request $request)
    {

        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
            'imagen' => 'required|image'
        ]);

        $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

        //Resize de la imagen, usando la librería intervention image
        $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
        $img->save();

        // DB::table('recetas')->insert([
        //     'titulo' => $data['titulo'],
        //     'ingredientes' => $data['ingredientes'],
        //     'preparacion' => $data['preparacion'],
        //     'user_id' => Auth::user()->id,
        //     'categoria_id' => $data['categoria'],
        //     'imagen' => $ruta_imagen,
        // ]);

        //Almacenar con modelo
        auth()->user()->recetas()->create([
            'titulo' => $data['titulo'],
            'ingredientes' => $data['ingredientes'],
            'preparacion' => $data['preparacion'],
            'categoria_id' => $data['categoria'],
            'imagen' => $ruta_imagen,
        ]);

        //Redireccionar
        return redirect()->route('recetas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receta  $receta
     * @return \Illuminate\Http\Response
     */
    public function show(Receta $receta)
    {
        //Obtener si al usuario actual le gusta la receta y está autenticado
        $like = (auth()->user() ) ? auth()->user()->meGusta->contains($receta->id) : false;

        //Pasar la cantidad de likes a la vista
        $likes = $receta->likes->count();

        //Pasar los comentarios a la vista
        $comentarios = $receta->comentarios;

        $cant_comentarios = count($comentarios);

        if($cant_comentarios > 3){
            $comentarios = $comentarios->take(3);
        }

        return view('recetas.show')->with('receta',$receta)->with('like', $like)->with('likes', $likes)->with('comentarios',$comentarios)->with('cant_comentarios',$cant_comentarios);
    }

    public function edit(Receta $receta)
    {
        $this->authorize('view', $receta);
        $categorias = CategoriaReceta::all(['id','nombre']);
        return view('recetas.edit')
            ->with('receta',$receta)
            ->with('categorias',$categorias);
    }

    public function update(Request $request, Receta $receta)
    {
        $this->authorize('update', $receta);
        //Validación
        $data = request()->validate([
            'titulo' => 'required|min:6',
            'categoria' => 'required',
            'ingredientes' => 'required',
            'preparacion' => 'required',
        ]);

        //Reasignación
        $receta->titulo = $data['titulo'];
        $receta->categoria_id = $data['categoria'];
        $receta->ingredientes = $data['ingredientes'];
        $receta->preparacion = $data['preparacion'];

        //Validar imagen

        if(request('imagen')){
            $ruta_imagen = $request['imagen']->store('upload-recetas', 'public');

            //Resize de la imagen, usando la librería intervention image
            $img = Image::make(public_path("storage/{$ruta_imagen}"))->fit(1000, 550);
            $img->save();
            $receta->imagen = $ruta_imagen;
        }
        $receta->save();
        return redirect()->route('recetas.index');
    }

    public function destroy(Receta $receta)
    {
        //Ejecutar el policy
        $this->authorize('delete', $receta);

        //Eliminar
        $receta->delete();

        return redirect()->route('recetas.index');
    }

    public function search(Request $request){
        $busqueda = $request->get('buscar');

        $recetas = Receta::where('titulo','like','%' . $busqueda . '%')->paginate(1);
        $recetas->appends(['buscar' => $busqueda]);

        return view('busquedas.show',compact('recetas', 'busqueda'));
    }
}
