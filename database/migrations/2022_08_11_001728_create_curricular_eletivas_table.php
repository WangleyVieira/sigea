<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurricularEletivasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curricular_eletivas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nome')->nullable();
            $table->text('codigo')->nullable();
            $table->bigInteger('cadastradoPorUsuario')->unsigned();
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
        Schema::dropIfExists('curricular_eletivas');
    }
}
