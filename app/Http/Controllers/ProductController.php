<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product as Product;

class ProductController extends Controller
{

//lista todos os produtos
    public function index(){

        $products = Product::all();

        return view('products.index', compact('products'));

    }


    public function create(){
        return view('products.create');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:75',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        //Eloquent - cria o produto
        Product::create($request->all());

        //redireciona para a página index, com mensagem de successo
        return redirect()
            ->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso!');

    }

    //Buscar apenas um produto
    public function show(Product $product){
        return view('products.show', compact('product'));
    }

    public function edit(Product $product){
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required|string|max:75',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $product->update($request->all());

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy(Product $product){

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto deletado com sucesso!');

    }
}
