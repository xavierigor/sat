<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDocumentosTcc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger para criar um novo registro em documentos_alunos
        // toda vez que um tcc for criado
        DB::unprepared('
        CREATE TRIGGER tr_Documentos_Aluno AFTER INSERT ON `tccs` FOR EACH ROW
            BEGIN
                INSERT INTO documentos_alunos (`tcc_id`) 
                VALUES (NEW.id);
            END'
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_Documentos_Aluno`');
    }
}
