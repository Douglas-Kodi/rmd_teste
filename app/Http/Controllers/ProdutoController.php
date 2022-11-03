<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;

class ProdutoController extends Controller
{
    public function index()
    {
        return Produto::orderBy('created_at', 'DESC')->where('deleted_at', '=', null)->get();
    }
    public function create()
    {

    }
    public function store(Request $request)
    {
        if(($request->nome)or($request->hasFile('imagem'))){
        $newProduto = new Produto;
        $newProduto->idcateg = $request->idcateg;
        $newProduto->nome = $request->nome;
        $newProduto->save();

            if($request->hasFile('imagem')){
                $destination_path = 'public/img/produto/';
                $image = $request->file('imagem');
                $image_name = $image->GetClientOriginalName();
                $path = $request->file('imagem')->storeAs($destination_path,$image_name);

                $newProduto->imagem = $image_name;
                $newProduto->save();
            }else{
                $newProduto->imagem = null;
                $newProduto->save();
            }
        }
        return $newProduto;
    }
    public function update(Request $request, $id)
    {
        $existingProduto = Produto::find($id);
        
        if($existingProduto){
            if($request->idcateg){
                $existingProduto->idcateg = $request->idcateg;
                $existingProduto->save();
            }
            if($request->nome){
                $existingProduto->nome = $request->nome;
                $existingProduto->save();
            }
            if($request->hasFile('imagemUp')){
                $destination_path = 'public/img/produto/';
                $image = $request->file('imagemUp');
                $image_name = $image->GetClientOriginalName();
                $path = $request->file('imagemUp')->storeAs($destination_path,$image_name);
                
                $existingProduto->imagem = $image_name;
                $existingProduto->save();
            }
            if($request->imagemUp=="clear"){
                $existingProduto->imagem = null;
                $existingProduto->save();
            }
        }
        return $existingProduto;
    }
    public function destroy($id)
    {
        $existingProduto = Produto::find($id);

        if($existingProduto){
            $existingProduto->deleted_at = date("Y-m-d\TH:i:s");
            $existingProduto->save();
            return "Produto successfully deleted.";
        }
        return "Produto not found.";
    }
}
