<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>

    <h1>Cadastrar Produto</h1>

    @if($errors->any())

        <ul>
            @foreach($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>

    @endif

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

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>
</html>
