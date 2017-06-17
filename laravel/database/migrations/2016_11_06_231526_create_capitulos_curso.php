<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCapitulosCurso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capitulos_curso', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nombre');
            $table->string('curso');
            $table->foreign('curso')->references('id')->on('cursos')->onDelete('cascade');
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
