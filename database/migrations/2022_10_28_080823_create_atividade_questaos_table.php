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
            $table->bigIncrements('id');

            $table->bigInteger('id_atividade')->unsigned()->nullable();
            $table->foreign('id_atividade')->references('id')->on('atividades');

            $table->bigInteger('id_questao')->unsigned()->nullable();
            $table->foreign('id_questao')->references('id')->on('questaos');
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
