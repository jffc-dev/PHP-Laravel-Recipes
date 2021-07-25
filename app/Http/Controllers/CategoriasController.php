<?php

namespace App\Http\Controllers;

use App\CategoriaReceta;
use App\Receta;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function show(CategoriaReceta $categoriaReceta){
        $recetas = Receta::where('categoria_id',$categoriaReceta->id)->paginate(3);

        return view('categorias.show',compact('recetas','categoriaReceta'));
    }

    public function index(){
        $categorias = CategoriaReceta::all();
        return view('categorias.index',compact('categorias'));
    }

    public function create(){
        return view('categorias.create');
    }

    public function store(Request $request){
        $data = request()->validate([
            'nombre' => 'required|min:3'
        ]);

        CategoriaReceta::create([
            'nombre' => $data["nombre"]
        ]);
        $categorias = CategoriaReceta::all();
        return view('categorias.index',compact('categorias'));
    }

    public function edit(CategoriaReceta $categoria){
        // return $categoria;
        return view('categorias.edit',compact('categoria'));
    }

    public function update(CategoriaReceta $categoria, Request $request){
        $data = request()->validate([
            'nombre' => 'required|min:3'
        ]);
        $categoria->nombre = $data["nombre"];
        $categoria->save();
        $categorias = CategoriaReceta::all();
        return view('categorias.index',compact('categorias'));
    }

    public function destroy(CategoriaReceta $categoria){
        $categoria->delete();
        return redirect()->route('categorias.index');
    }
}
