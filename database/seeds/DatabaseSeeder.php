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

        DB::table('coordenadores')->insert([
            'name' => 'Coordenador',
            'email' => 'coordenador@gmail.com',
            'password' => Hash::make('teste123'),
        ]);

        DB::table('professores')->insert([
            'name' => 'Professor',
            'email' => 'professor@gmail.com',
            'password' => Hash::make('teste123'),
            'matricula' => '271029664',
            'data_nasc' => '1990-10-10',
            'area_de_interesse' => 'Inteligência Artificial',
        ]);

        DB::table('users')->insert([
            'name' => 'Aluno',
            'email' => 'aluno@gmail.com',
            'password' => Hash::make('teste123'),
            'matricula' => '760278465',
            'data_nasc' => '1996-02-12',
        ]);
    }
}