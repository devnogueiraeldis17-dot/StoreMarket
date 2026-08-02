@extends('layouts.base')

@section('title' , $product->name)

@section('content')
    <h1>{{ $product->name }}</h1>

    <p>
        <strong>ID:</strong>
        {{ $product->id }}
    </p>

    <p>
        <strong>Descrição:</strong>
        {{ $product->description }}
    </p>

    <p>
        <strong>Preço:</strong>
        R$ {{ number_format($product->price, 2, ',', '.') }}
    </p>

    <p>
        <strong>Estoque:</strong>
        {{ $product->stock }}
    </p>

    <a href="{{ route('products.edit', $product) }}">
        Editar
    </a>

    <br><br>

    <a href="{{ route('products.index') }}">
        Voltar
    </a>

@endsection
