<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topicos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descricao')->nullable();

            //referências
            $table->bigInteger('id_disciplina')->unsigned()->nullable();
            $table->foreign('id_disciplina')->references('id')->on('disciplinas');

            $table->bigInteger('cadastradoPorUsuario')->unsigned()->nullable();
            $table->foreign('cadastradoPorUsuario')->references('id')->on('users');
            $table->bigInteger('alteradoPorUsuario')->unsigned()->nullable();
            $table->foreign('alteradoPorUsuario')->references('id')->on('users');
            $table->bigInteger('inativadoPorUsuario')->unsigned()->nullable();
            $table->foreign('inativadoPorUsuario')->references('id')->on('users');
            $table->date('dataInativado')->nullable();
            $table->text('motivoInativado')->nullable();
            $table->boolean('ativo');
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
        Schema::dropIfExists('topicos');
    }
}
