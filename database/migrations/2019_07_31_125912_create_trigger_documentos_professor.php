<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTriggerDocumentosProfessor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger para criar um novo registro em documentos_professores
        // toda vez que um professor for cadastrado
        DB::unprepared('
        CREATE TRIGGER tr_Documentos_Professor AFTER INSERT ON `professores` FOR EACH ROW
            BEGIN
                INSERT INTO documentos_professores (`professor_id`) 
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
        DB::unprepared('DROP TRIGGER `tr_Documentos_Professor`');
    }
}
