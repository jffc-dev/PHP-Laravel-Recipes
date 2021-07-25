<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentarioRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentario_recetas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receta_id')->references('id')->on('recetas')->onDelete('cascade')->comment('Relación entre el comentario y la recete en la que se publicó.');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade')->comment('Relación entre el comentario y el usuario que lo publicó.');
            $table->text('contenido');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comentario_recetas');
    }
}
