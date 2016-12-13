<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('museu_id')->unsigned();
            $table->integer('tema_id')->unsigned();
            $table->integer('evento_tipo_id')->unsigned();
            $table->text('descricao');
            $table->boolean('no_endereco_do_museu')->default(1);
            $table->date('inicio_evento');
            $table->date('fim_evento');
            $table->string('hora_inicio_evento');
            $table->string('hora_fim_evento');
            $table->string('local');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->timestamps();
            $table->foreign('museu_id')->references('id')->on('museus');
            $table->foreign('tema_id')->references('id')->on('temas');
            $table->foreign('evento_tipo_id')->references('id')->on('evento_tipos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
