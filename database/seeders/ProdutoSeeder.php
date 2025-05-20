<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produto::create([
            'nome' => 'Cadeira Gamer',
            'descricao' => 'Cadeira gamer',
            'preco' => '1500',
            'imagem' => '/storage/images/cadeira_gamer_fox_racer.png'
        ]);
        Produto::create([
            'nome' => 'Sofa',
            'descricao' => 'Sofa 3 lugares',
            'preco' => '2000',
            'imagem' => '/storage/images/Sofa_retratil_3lugares.png'
        ]);
        Produto::create([
            'nome' => 'Geladeira',
            'descricao' => 'Geladeira HQ',
            'preco' => '3500',
            'imagem' => '/storage/images/Geladeira_HQ_Frost.png'
        ]);
        Produto::create([
            'nome' => 'Televisao',
            'descricao' => 'Televisao 40 polegadas',
            'preco' => '2000',
            'imagem' => ''
        ]);
        Produto::create([
            'nome' => 'Conjunto mesa',
            'descricao' => 'Conjunto Mesa e Cadeira 6 lugares',
            'preco' => '1100',
            'imagem' => '/storage/images/conjunto_mesa_6lugares.png'
        ]);
        Produto::create([
            'nome' => 'Cama Box Solteiro',
            'descricao' => 'Cama Box Solteiro',
            'preco' => '900',
            'imagem' => '/storage/images/cama_box_solteiro.png'
        ]);
        Produto::create([
            'nome' => 'Cama Box Casal',
            'descricao' => 'Cama Box Casal',
            'preco' => '1500',
            'imagem' => '/storage/images/cama_box_casal.png'
        ]);
        Produto::create([
            'nome' => 'Cama Beliche Solteiro',
            'descricao' => 'Cama Beliche Solteiro',
            'preco' => '1600',
            'imagem' => '/storage/images/cama_beliche_solteiro'
        ]);
        Produto::create([
            'nome' => 'Televisao',
            'descricao' => 'Televisao 55 polegadas',
            'preco' => '2000',
            'imagem' => ''
        ]);
    }
}
