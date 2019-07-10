<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrientandosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientandos', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->unsignedBigInteger('orientador_id');
            $table->unsignedBigInteger('aluno_id');

            $table->foreign('orientador_id')->references('id')->on('professores')->onDelete('cascade');
            $table->foreign('aluno_id')->references('id')->on('users')->onDelete('cascade');
            
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
        Schema::dropIfExists('orientandos');
    }
}
