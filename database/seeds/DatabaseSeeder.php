<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('datas')
            ->insert([
            [
                'nome' => 'definir orientador',
                'usuario' => 'aluno'
            ],
            [
                'nome' => 'termo de compromisso',
                'usuario' => 'aluno'
            ],
            [
                'nome' => 'termo de responsabilidade',
                'usuario' => 'professor'
            ],
            [
                'nome' => 'relatorio de acompanhamento',
                'usuario' => 'aluno'
            ],
        ]);

        DB::table('coordenadores')->insert([
            'name' => 'Coordenador',
            'email' => 'coordenador@gmail.com',
            'password' => Hash::make('teste123'),
        ]);

        DB::table('professores')
            ->insert([
            [
                'name' => 'Professor',
                'email' => 'professor@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '271029664',
                'data_nasc' => '1990-10-10',
                'telefone' => '(83) 9 8909-2369',
                'area_de_interesse' => null,
            ],
            [
                'name' => 'Pablo Suárez',
                'email' => 'pablo@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '579029424',
                'data_nasc' => '1990-10-10',
                'telefone' => '(83) 9 9926-4379',
                'area_de_interesse' => 'Engenharia de Software',
            ],
            [
                'name' => 'Aislânia Alves',
                'email' => 'aislania@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '876390754',
                'data_nasc' => '1990-10-10',
                'telefone' => '(83) 9 9301-1271',
                'area_de_interesse' => 'Banco de Dados, Robótica',
            ],
            [
                'name' => 'Amanda Sobral',
                'email' => 'amanda@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '171826754',
                'data_nasc' => '1990-10-10',
                'telefone' => '(83) 9 9101-8864',
                'area_de_interesse' => 'Redes de Computadores',
            ],
            [
                'name' => 'Jucélio Soares',
                'email' => 'jucelio@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '989765872',
                'data_nasc' => '1990-10-10',
                'telefone' => '(83) 9 9377-6598',
                'area_de_interesse' => 'Segurança de Dados',
            ],
        ]);

        DB::table('users')
            ->insert([
            [
                'name' => 'Aluno',
                'email' => 'aluno@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '760278465',
                'telefone' => null,
                'data_nasc' => '1996-02-12',
            ],
            [
                'name' => 'Igor Xavier',
                'email' => 'igor@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '152810226',
                'telefone' => '(83) 9 9372-4561',
                'data_nasc' => '1997-10-21',
            ],
            [
                'name' => 'Leandro Medeiros',
                'email' => 'leandro@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '390689994',
                'telefone' => null,
                'data_nasc' => '1998-05-15',
            ],
            [
                'name' => 'Abmael Bandeira',
                'email' => 'abmael@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '690189094',
                'telefone' => '(83) 9 9980-0276',
                'data_nasc' => '1997-10-23',
            ],
            [
                'name' => 'Denilo Diniz',
                'email' => 'denilo@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '852508994',
                'telefone' => null,
                'data_nasc' => '1997-02-03',
            ],
            [
                'name' => 'Wanessa',
                'email' => 'wanessa@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '652881355',
                'telefone' => '(83) 9 9922-6111',
                'data_nasc' => '1996-07-19',
            ],
            [
                'name' => 'Mirelly',
                'email' => 'mirelly@gmail.com',
                'password' => Hash::make('teste123'),
                'matricula' => '611607430',
                'telefone' => null,
                'data_nasc' => '1996-07-29',
            ],
        ]);

        DB::table('tccs')->insert([
            [
                'user_id' => 1,
                'tcc' => 'tcc 2',
            ],
            [
                'user_id' => 2,
                'tcc' => 'tcc 1',
            ],
            [
                'user_id' => 3,
                'tcc' => 'tcc 1',
            ],
            [
                'user_id' => 4,
                'tcc' => 'tcc 1',
            ],
            [
                'user_id' => 5,
                'tcc' => 'tcc 2',
            ],
            [
                'user_id' => 6,
                'tcc' => 'tcc 1',
            ],
            [
                'user_id' => 7,
                'tcc' => 'tcc 2',
            ],
        ]);
    }
}