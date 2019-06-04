<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Coordenador;


class CoordenadorTest extends TestCase
{
    // use DatabaseTransactions;

    public function testCriarCoordenador(){

        $coordenador = new Coordenador;
        $coordenador->id = 1;
        $coordenador->name = 'Rodrigo Costa';
        $coordenador->password = bcrypt('teste123');
        $coordenador->email = 'rodrigo@gmail.com';
        $this->assertTrue($coordenador->save());

        $coordenador2 = new Coordenador;
        $coordenador2->id = 2;
        $coordenador2->name = 'Jannayna Domingues';
        $coordenador2->password = bcrypt('teste123');
        $coordenador2->email = 'jannayna@gmail.com';
        $this->assertTrue($coordenador2->save());
    }

    public function testVerificarCoordenadores(){

        $this->assertDatabasehas('coordenadores',[
            'id'=>1,
            'name'=>'Rodrigo Costa'
        ]);

        $this->assertDatabasehas('coordenadores',[
            'id'=>2,
            'name'=>'Jannayna Domingues'
        ]);
    }

    public function testDeletarCoordenador(){
        $coordenador = Coordenador::find(2);
        $this->assertTrue($coordenador->delete());
    }

    public function testVerificarCoordenadoresDeletados(){

        $this->assertDatabaseMissing('coordenadores',[
            'id'=>2
        ]);
    }

}
