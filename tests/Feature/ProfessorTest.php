<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Professor;

class ProfessorTest extends TestCase
{
    public function testCadastrarprofessor(){

        $professor1 = new Professor;
        $professor1->id = 1;
        $professor1->name = 'Pablo Suárez';
        $professor1->email = 'pablo@gmail.com';
        $professor1->password = bcrypt('teste123');
        $professor1->matricula = '579029424';
        $professor1->data_nasc = '1990-10-10';
        $professor1->telefone = '(83) 9 8909-2369';
        $professor1->area_de_interesse = 'Engenharia de Software';
        $this->assertTrue($professor1->save());

        $professor2 = new Professor;
        $professor2->id = 2;
        $professor2->name = 'Aislânia Alvez';
        $professor2->email = 'aislania@gmail.com';
        $professor2->password = bcrypt('teste123');
        $professor2->matricula = '123456789';
        $professor2->data_nasc = '1990-10-10';
        $professor2->telefone = '(84) 9 7896-2523';
        $professor2->area_de_interesse = 'Banco de Dados';
        $this->assertTrue($professor2->save());

        $professor3 = new Professor;
        $professor3->id = 3;
        $professor3->name = 'Laudson Sousa';
        $professor3->email = 'laudson@gmail.com';
        $professor3->password = bcrypt('teste123');
        $professor3->matricula = '156487999';
        $professor3->data_nasc = '1990-10-10';
        $professor3->telefone = '(83) 9 4002-8922';
        $professor3->area_de_interesse = 'Tudo';
        $this->assertTrue($professor3->save());

        $professor4 = new Professor;
        $professor4->id = 4;
        $professor4->name = 'Amanda Mayara';
        $professor4->email = 'amanda@gmail.com';
        $professor4->password = bcrypt('teste123');
        $professor4->matricula = '556778996';
        $professor4->data_nasc = '1990-10-10';
        $professor4->telefone = '(83) 9 4546-4789';
        $professor4->area_de_interesse = 'Compiladores';
        $this->assertTrue($professor4->save());
    }

    public function testVerificarProfessores(){

        $this->assertDatabasehas('professores',[
            'id'=>1,
        ]);

        $this->assertDatabasehas('professores',[
            'id'=>2,
        ]);

        $this->assertDatabasehas('professores',[
            'id'=>3,
        ]);

        $this->assertDatabasehas('professores',[
            'id'=>4,
        ]);
    }

    public function testDeletarProfessor(){

        $professor = Professor::find(4);
        $this->assertTrue($professor->delete());
    }

    public function testVerificarProfessoresDeletados(){

        $this->assertDatabaseMissing('professores',[
            'id'=>4
        ]);
    }
}

