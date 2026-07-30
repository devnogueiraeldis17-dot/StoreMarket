<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
</head>
<body>

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


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
