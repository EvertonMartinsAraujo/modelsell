<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto';
    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'imagem',
    ];

    //REGRAS DE CRIAÇÂO
    public static function regras(){
        return [
	        'nome' => 'required|string|max:200',
	        'descricao' => 'required|string',
	        'preco'=> 'required|numeric:produtos,preco',
            'imagem' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
            
	    ];
    }
    //RETORNO
    public static function feedback(){
        return [
            'required' => 'O campo :attribute é obrigatório',
            'preco.numeric' => 'O preço deve ser numerico',
            'imagem.mimes' => 'O arquivo de imagem invalido, permitido apenas png, jpg e jpeg',
            'imagem.max' => 'A imagem ultrapassa o tamanho limite'
        ];
    }

}
