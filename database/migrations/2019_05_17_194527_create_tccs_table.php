<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTccsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tccs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('disciplina')->default('tcc 1');
            $table->string('titulo')->nullable();
            $table->string('area_de_pesquisa')->nullable();

            $table->unsignedBigInteger('user_id');

            // Acho que isso não é necessário, já que agora existe a tabela orientacoes
            $table->unsignedBigInteger('orientador_id')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('professores');
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
        Schema::dropIfExists('tccs');
    }
}
