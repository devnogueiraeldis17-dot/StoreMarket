@extends('layouts.base')

@section('title' , 'Cadastrar Produtos')

@section('content')
    <h1>Cadastrar Produto</h1>

    <x-validation-errors />

    <form action="{{ route('products.store') }}" method="POST">

        @csrf

        <div>
            <label>Nome:</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
            >
        </div>

        <br>

        <div>
            <label>Descrição:</label>
            <textarea name="description">{{ old('description') }}</textarea>
        </div>

        <br>

        <div>
            <label>Preço:</label>
            <input
                type="number"
                name="price"
                step="0.01"
                value="{{ old('price') }}"
            >
        </div>

        <br>

        <div>
            <label>Estoque:</label>
            <input
                type="number"
                name="stock"
                value="{{ old('stock') }}"
            >
        </div>

        <br>

        <button class="btn waves-effect waves-light" type="submit">
            Cadastrar
            <i class="material-icons right">send</i>
        </button>

    </form>

    <br>

    <a href="{{ route('products.index') }}">
        Voltar
    </a>

@endsection
