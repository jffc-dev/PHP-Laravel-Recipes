<?php

namespace App\Http\Controllers;

use App\ComentarioReceta;
use App\Receta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentarioRecetaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request, Receta $receta)
    {
        $data = request()->validate([
            'contenido' => 'required'
        ]);
        $receta->comentarios()->create([
            'user_id' => Auth::id(),
            'contenido' => $data['contenido']
        ]);
        return redirect()->route('recetas.show',['receta'=>$receta->id]);
    }

    public function show(ComentarioReceta $comentarioReceta)
    {
        //
    }

    public function edit(ComentarioReceta $comentarioReceta)
    {
        //
    }

    public function update(Request $request, ComentarioReceta $comentarioReceta)
    {
        //
    }

    public function destroy(ComentarioReceta $comentarioReceta)
    {
        //
    }
}
