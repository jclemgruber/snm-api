<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuseusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->integer('user_id')->unsigned();
            $table->integer('instituicao_tipo_id')->unsigned();
            $table->string('site')->nullable();
            $table->string('email');
            $table->string('fone1');
            $table->string('fone2')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('instituicao_tipo_id')->references('id')->on('instituicao_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museus');
    }
}
