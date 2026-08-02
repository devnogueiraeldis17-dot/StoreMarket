@extends('layouts.base')

@section('title', 'Editar produtos')

@section('content')

    <h1>Editar Produto</h1>

    <x-validation-errors />

    <form
        action="{{ route('products.update', $product) }}"
        method="POST"
    >

        @csrf
        @method('PUT')

        <div>
            <label>Nome:</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $product->name) }}"
            >
        </div>

        <br>

        <div>
            <label>Descrição:</label>

            <textarea name="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <br>

        <div>
            <label>Preço:</label>

            <input
                type="number"
                name="price"
                step="0.01"
                value="{{ old('price', $product->price) }}"
            >
        </div>

        <br>

        <div>
            <label>Estoque:</label>

            <input
                type="number"
                name="stock"
                value="{{ old('stock', $product->stock) }}"
            >
        </div>

        <br>

        <button class="btn waves-effect waves-light" type="submit">
            Atualizar
        </button>

    </form>

    <br>

    <a href="{{ route('products.index') }}">
        Voltar
    </a>

@endsection
