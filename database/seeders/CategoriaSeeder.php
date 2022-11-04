<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'nome' => 'Fruta',
                'imagem' => 'fruta.png',
                'deleted_at' => null,
            ], 
            [
                'nome' => 'Vegetal',
                'imagem' => 'vegetal.png',
                'deleted_at' => null,
            ],      
        ];
        Categoria::insert($categorias);
    }
}
