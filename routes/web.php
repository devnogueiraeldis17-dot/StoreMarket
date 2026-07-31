<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/', function(){
    return redirect()->route('products.index');
});

//Rota Resource() - para criar rotas CRUD automaticamente
Route::resource('products', ProductController::class);


