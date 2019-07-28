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
            $table->string('tcc')->default('tcc 1');
            $table->string('titulo')->nullable();
            $table->string('area_de_pesquisa')->nullable();

            $table->unsignedBigInteger('user_id');
            // $table->unsignedBigInteger('prof_solicitado')->nullable();
            // Acho que isso não é necessário, já que agora existe a tabela orientacoes
            $table->unsignedBigInteger('orientador_id')->nullable(); 

            $table->string('termo_de_compromisso')->nullable();
            $table->string('tc_status')->default('pendente');
            
            $table->string('rel_acompanhamento')->nullable();
            $table->string('ra_status')->default('pendente')->nullable();
            
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
