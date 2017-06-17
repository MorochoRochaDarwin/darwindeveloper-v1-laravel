<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTutoriales extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoriales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo')->nullable(false);
            $table->text('descripcion')->nullable(false);
            $table->longText('html')->nullable(false);
            $table->string('palabras_clave')->nullable(false);
            $table->timestamps();
            $table->integer('sub_id')->unsigned();
            $table->foreign('sub_id')->references('id')->on('sub_categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutoriales');
    }
}
