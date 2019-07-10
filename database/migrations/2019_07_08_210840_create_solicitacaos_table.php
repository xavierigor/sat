<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSolicitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitacaos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('tipo_solicitacao')->default('orientacao'); // Orientação ou Coorientação
            $table->unsignedBigInteger('solicitante_id');
            $table->unsignedBigInteger('solicitado_id');

            $table->foreign('solicitante_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('solicitado_id')->references('id')->on('professores')->onDelete('cascade');

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
        Schema::dropIfExists('solicitacaos');
    }

    
}
