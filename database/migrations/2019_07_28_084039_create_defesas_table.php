<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDefesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defesas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('aluno_id');
            $table->unsignedBigInteger('orientador_id')->nullable();
            $table->unsignedBigInteger('avaliador_2_id')->nullable();
            $table->unsignedBigInteger('avaliador_3_id')->nullable();

            $table->string('orientador_name')->nullable(); 
            $table->string('avaliador_2_name')->nullable();
            $table->string('avaliador_3_name')->nullable();

            $table->date('data');
            $table->string('hora');
            $table->string('sala');

            $table->foreign('aluno_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('orientador_id')->references('id')->on('professores')->onDelete('cascade');
            $table->foreign('avaliador_2_id')->references('id')->on('professores')->onDelete('cascade');
            $table->foreign('avaliador_3_id')->references('id')->on('professores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defesas');
    }
}
