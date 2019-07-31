<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentosAlunosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos_alunos', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('tcc_id');

            $table->string('termo_de_compromisso')->nullable();
            $table->string('rel_acompanhamento')->nullable();

            // Timestamps
            $table->dateTime('ra_updated_at')->nullable();
            $table->dateTime('tc_updated_at')->nullable();
            // $table->dateTime('ra_created_at')->nullable();
            // $table->dateTime('tc_created_at')->nullable();

            $table->string('ra_status')->nullable();
            $table->string('tc_status')->nullable();

            $table->foreign('tcc_id')->references('id')->on('tccs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documentos_alunos');
    }
}
