<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;

class AlunoTest extends TestCase
{
    public function testCadastrarAlunos(){

        $aluno1 = new User;
        $aluno1->id = 1;
        $aluno1->name = 'Abmael Bandeira';
        $aluno1->email = 'abmael@gmail.com';
        $aluno1->password = bcrypt('teste123');
        $aluno1->matricula = '159753852';
        $aluno1->data_nasc = '1995-11-10';
        $this->assertTrue($aluno1->save());

        $aluno2 = new User;
        $aluno2->id = 2;
        $aluno2->name = 'Denilo Diniz';
        $aluno2->email = 'denilo@gmail.com';
        $aluno2->password = bcrypt('teste123');
        $aluno2->matricula = '152810285';
        $aluno2->data_nasc = '1997-05-09';
        $this->assertTrue($aluno2->save());

        $aluno3 = new User;
        $aluno3->id = 3;
        $aluno3->name = 'Leandro Medeiros';
        $aluno3->email = 'leandro@gmail.com';
        $aluno3->password = bcrypt('teste123');
        $aluno3->matricula = '152830753';
        $aluno3->data_nasc = '1997-12-07';
        $this->assertTrue($aluno3->save());

        $aluno4 = new User;
        $aluno4->id = 4;
        $aluno4->name = 'Igor Xavier';
        $aluno4->email = 'igor@gmail.com';
        $aluno4->password = bcrypt('teste123');
        $aluno4->matricula = '152810300';
        $aluno4->data_nasc = '1998-11-10';
        $this->assertTrue($aluno4->save());

        $aluno5 = new User;
        $aluno5->id = 5;
        $aluno5->name = 'Wanessa Cavalcante';
        $aluno5->email = 'wanessa@gmail.com';
        $aluno5->password = bcrypt('teste123');
        $aluno5->matricula = '152810999';
        $aluno5->data_nasc = '1994-07-15';
        $this->assertTrue($aluno5->save());

        $aluno6 = new User;
        $aluno6->id = 6;
        $aluno6->name = 'Mirely';
        $aluno6->email = 'mirely@gmail.com';
        $aluno6->password = bcrypt('teste123');
        $aluno6->matricula = '152810555';
        $aluno6->data_nasc = '1995-12-29';
        $this->assertTrue($aluno6->save());
    }

    public function testVerificarAlunos(){

        $this->assertDatabasehas('users',[
            'id'=>1,
        ]);

        $this->assertDatabasehas('users',[
            'id'=>2,
        ]);

        $this->assertDatabasehas('users',[
            'id'=>3,
        ]);

        $this->assertDatabasehas('users',[
            'id'=>4,
        ]);

        $this->assertDatabasehas('users',[
            'id'=>5,
        ]);

        $this->assertDatabasehas('users',[
            'id'=>6,
        ]);
    }

    public function testDeletarAluno(){

        $aluno = User::find(6);
        $this->assertTrue($aluno->delete());
    }

    public function testVerificarAlunosDeletados(){

        $this->assertDatabaseMissing('users',[
            'id'=>6
        ]);
    }
}
