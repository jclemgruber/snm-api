<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMuseuEnderecosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('museu_enderecos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('museu_id')->unsigned();
            $table->integer('endereco_tipo_id')->unsigned()->default(1);
            $table->integer('cidade_id')->unsigned();
            $table->string('logradouro');
            $table->string('numero');
            $table->string('complemento')->nullable();
            $table->string('bairro');
            $table->string('cep');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->foreign('museu_id')->references('id')->on('museus');
            $table->foreign('endereco_tipo_id')->references('id')->on('endereco_tipos');
            $table->foreign('cidade_id')->references('id')->on('cidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('museu_enderecos');
    }
}
