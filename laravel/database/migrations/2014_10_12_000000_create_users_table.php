<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('email')->unique();
            $table->string('facebook_id')->unique()->nullable(true);
            $table->string('github_id')->unique()->nullable(true);
            $table->string('google_id')->unique()->nullable(true);
            $table->string('twitter_id')->unique()->nullable(true);
            $table->string('password')->nullable(true);
            $table->enum('type',['super','normal'])->default('normal');
            $table->rememberToken()->nullable(true);
            $table->string('verify_token')->nullable(true);
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
        Schema::drop('users');
    }
}
