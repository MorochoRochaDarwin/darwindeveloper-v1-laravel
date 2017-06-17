<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntradasCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('titulo');
            $table->string('descripcion')->nullable(true);
            $table->longText('html')->nullable(false);
            $table->string('palabras_clave')->nullable(false);
            $table->integer('capitulo')->unsigned();
            $table->foreign('capitulo')->references('id')->on('capitulos_curso')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
