<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $fillable = [
        'titulo', 'ingredientes', 'preparacion', 'imagen', 'categoria_id'
    ];

    //Obtiene la categoria de la receta via FK
    public function categoria(){
        return $this->belongsTo(CategoriaReceta::class);
    }
    //Obtiene la información del usuario vía FK
    public function autor(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //Likes que ha recibido una receta
    public function likes(){
        return $this->belongsToMany(User::class,'likes_receta');
    }

    //Comentarios que ha recibido la receta
    public function comentarios(){
        return $this->hasMany(ComentarioReceta::class);
    }
}
