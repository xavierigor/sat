<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_professores', function (Blueprint $table) {
            $table->bigIncrements('id');

            // Caso professor tenha mais um documento
            // será preciso criar um timestamp para cada documento
            // como na migration create_documentos_alunos_table
            
            $table->unsignedBigInteger('professor_id');
            
            $table->string('termo_de_responsabilidade')->nullable();
            $table->string('tr_status')->nullable();
            
            $table->dateTime('updated_at')->nullable();

            $table->foreign('professor_id')->references('id')->on('professores')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_professores');
    }
}
