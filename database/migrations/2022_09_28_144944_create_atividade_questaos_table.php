<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtividadeQuestaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividade_questaos', function (Blueprint $table) {
            // $table->bigIncrements('id');
            $table->text('descricao_atividade')->nullable();
            $table->text('titulo_atividade')->nullable();

            //relação
            $table->bigInteger('id_atividade')->unsigned();
            $table->foreign('id_atividade')->references('id')->on('atividades');
            $table->bigInteger('id_questao')->unsigned();
            $table->foreign('id_questao')->references('id')->on('questaos');

            $table->bigInteger('cadastradoPorUsuario')->unsigned();
            $table->foreign('cadastradoPorUsuario')->references('id')->on('users');
            $table->bigInteger('alteradoPorUsuario')->unsigned();
            $table->foreign('alteradoPorUsuario')->references('id')->on('users');
            $table->bigInteger('inativadoPorUsuario')->unsigned();
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
        Schema::dropIfExists('atividade_questaos');
    }
}
