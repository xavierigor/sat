<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('matricula')->unique();
            $table->date('data_nasc');
            $table->string('telefone')->nullable();
            $table->string('image')->nullable();
            $table->string('area_de_interesse')->nullable();
            $table->string('termo_de_responsabilidade')->nullable();

            $table->integer('num_orientandos')->default(0);
            $table->integer('num_coorientandos')->default(0);
            $table->boolean('disponivel_orient')->default(true);
            $table->boolean('disponivel_coorient')->default(true);

            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('professores');
    }
}
