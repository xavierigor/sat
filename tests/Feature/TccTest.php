<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
use App\Tcc;

class TccTest extends TestCase
{
    // Todo TCC é criado após cadastrar um aluno, mas para os teste é preciso criar um Tcc 
    // separadamente e vincular à um aluno existente.
    public function testCadastrarTcc(){

        $tcc1 = new Tcc;
        $tcc1->id = 1;
        $tcc1->titulo = 'Triggers';
        $tcc1->area_de_pesquisa = 'Banco de Dados';
        $tcc1->user_id = '1';
        $this->assertTrue($tcc1->save());

        $tcc2 = new Tcc;
        $tcc2->id = 2;
        $tcc2->titulo = 'Requisitos Funcionais';
        $tcc2->area_de_pesquisa = 'Engenharia de Software';
        $tcc2->user_id = '2';
        $this->assertTrue($tcc2->save());

        $tcc3 = new Tcc;
        $tcc3->id = 3;
        $tcc3->titulo = 'Unity';
        $tcc3->area_de_pesquisa = 'Jogos Digitais';
        $tcc3->user_id = '3';
        $this->assertTrue($tcc3->save());

        $tcc4 = new Tcc;
        $tcc4->id = 4;
        $tcc4->titulo = 'PMBok';
        $tcc4->area_de_pesquisa = 'Gerenciamento de Projetos';
        $tcc4->user_id = '4';
        $this->assertTrue($tcc4->save());

        $tcc5 = new Tcc;
        $tcc5->id = 5;
        $tcc5->titulo = 'Desenvolvimento em Java';
        $tcc5->area_de_pesquisa = 'Lingragem de Programação 2';
        $tcc5->user_id = '5';
        $this->assertTrue($tcc5->save());
    }

    public function testVerificarTcc(){

        $this->assertDatabasehas('tccs',[
            'id'=>1,
        ]);

        $this->assertDatabasehas('tccs',[
            'id'=>2,
        ]);

        $this->assertDatabasehas('tccs',[
            'id'=>3,
        ]);

        $this->assertDatabasehas('tccs',[
            'id'=>4,
        ]);

        $this->assertDatabasehas('tccs',[
            'id'=>5,
        ]);
    }

    public function testCrudCompletoTcc(){
        //Cadastrando um novo aluno.
        $aluno = new User;
        $aluno->id = 6;
        $aluno->name = 'Mirely';
        $aluno->email = 'mirely@gmail.com';
        $aluno->password = bcrypt('teste123');
        $aluno->matricula = '152810555';
        $aluno->data_nasc = '1995-12-29';
        $this->assertTrue($aluno->save());

        //Cadastrando um novo tcc e vinculando ao aluno cadastrado.
        $tcc = new Tcc;
        $tcc->id = 6;
        $tcc->titulo = 'Desenvolvimento de Sites';
        $tcc->area_de_pesquisa = 'Programação Web';
        $tcc->user_id = '6';
        $this->assertTrue($tcc->save());

        //Verificando existencia do aluno no BD.
        $this->assertDatabasehas('users',[
            'id'=>6,
        ]);

        //Verificando existencia do tcc no BD.
        $this->assertDatabasehas('tccs',[
            'id'=>6,
        ]);

        //Deletando aluno do DB;
        $alunoDelete = User::find(6);
        $this->assertTrue($alunoDelete->delete());
        
        // //Deletando tcc do DB;
        // $tccDelete = Tcc::find(6);
        // $this->assertTrue($tccDelete->delete());

        //Verificando exclusão do aluno.
        $this->assertDatabaseMissing('users',[
            'id'=>6
        ]);

         //Verificando exclusão do tcc.
        $this->assertDatabaseMissing('tccs',[
            'id'=>6
        ]);
    }
}
