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
            'password' => Hash::make('12345678')
        ]);
        // DB::table('professors')->insert([
        //     'name' => 'Professor',
        //     'email' => 'professor@gmail.com',
        //     'password' => Hash::make('12345678')
        // ]);
        // DB::table('alunos')->insert([
        //     'name' => 'Aluno',
        //     'email' => 'aluno@gmail.com',
        //     'password' => Hash::make('12345678')
        // ]);
    }
}