<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'url', 'rango'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Evento que se ejecuta cuando se crea un usuario

    protected static function boot(){
        parent::boot();
        //Asignar perfil al crearse un usuario nuevo
        static::created(function ($user){
            $user->perfil()->create();
        });
    }

    // Relacion de uno a muchos, entre usuarios y recetas

    public function recetas(){
        return $this->hasMany(Receta::class);
    }

    public function perfil(){
        return $this->hasOne(Perfil::class);
    }

    //Recetas a las que el usuario le ha dado me gusata
    public function meGusta(){
        return $this->belongsToMany(Receta::class, 'likes_receta');
    }

    public function comentarioRecetas(){
        return $this->hasMany(ComentarioReceta::class);
    }
}
