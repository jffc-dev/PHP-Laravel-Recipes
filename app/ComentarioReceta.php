<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ComentarioReceta extends Model
{
    protected $fillable = [
        'receta_id', 'user_id', 'contenido'
    ];

    //Obtiene la receta via FK
    public function receta(){
        return $this->belongsTo(Receta::class,'receta_id');
    }

    //Obtiene el autor via FK
    public function autor(){
        return $this->belongsTo(User::class,'user_id');
    }
}
