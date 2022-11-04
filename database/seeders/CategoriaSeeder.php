<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert(
            [
                [
                    'nome' => 'Fruta',
                    'imagem' => 'fruta.png'
                ], 
                [
                    'nome' => 'Vegetal',
                    'imagem' => 'vegetal.png'
                ],      
            ]
        );
    }
}
