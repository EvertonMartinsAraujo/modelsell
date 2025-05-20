<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param App\Models\Produto $produto
     */
    public function index()
    {
        return Produto::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate( Produto::regras(), Produto::feedback());
        
        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('images','public');

        $produto = Produto::create(
            [
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'imagem' => $imagem_urn
            ]
        );
        return response() -> json($produto, 201);

    }

    /**
     * Display the specified resource.
     * @param App\Models\Produto $produto
     */
    public function show(Produto $produto)
    {
        return $produto;
    }

    /**
     * Update the specified resource in storage.
     * @param App\Models\Produto $produto
     */
    public function update(Request $request,Produto $produto)
    {
        //metodo parcial
       /* if($request->method() === 'PATCH'){

            //separar apenas a regra q vai ser aplicada
            $regraDinamica = [];

            //percorre a requisiçao e confere se tem regra
            foreach($produto->regras() as $input => $regra){

                //separa a regra em questao pra validacao

                if ($request->filled($input)){
                    $regraDinamica[$input]= $regra;
                     
                }
                
            }
            //validar a regra dinamica e retornar o feedback se for preciso
            $request->validate($regraDinamica, Produto::feedback());
           
        } else {
            //se nao for patch valida direto
            
            $request->validate(Produto::regras(), Produto::feedback());


        }*/
        $request->validate(Produto::regras(), Produto::feedback());
        //Se tiver imagem
        if ($request->hasFile('imagem')) {
            //Remover imagem antiga (se existir)
            if ($produto->imagem && Storage::exists($produto->imagem)) {
                Storage::delete($produto->imagem);
            }

            //Salvar nova imagem
            $imagem = $request->file('imagem');
            $imagem_armazenada = $imagem->store('images', 'public');
            $produto->imagem = $imagem_armazenada;
        }
 
        //Atualizar os demais campos (exceto imagem)
        $produto->fill($request->except('imagem'));
        $produto->save();

        return response()->json(['mensagem' => 'Produto atualizado!','produto' => $produto], 200);
    

    }

    /**
     * Remove the specified resource from storage.
     * @param App\Models\Produto $produto
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return ['Cadastro excluido'];
    }
}
