<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>

    <h1>Produtos</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif



    <hr>

    @if($products->count() > 0)

        <table border="1"cellpadding="10">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Preço</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>

                @foreach($products as $product)

                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>

                        <td>
                            R$ {{ number_format($product->price, 2, ',', '.') }}
                        </td>

                        <td>{{ $product->stock }}</td>

                        <td>

                            <a href="{{ route('products.show', $product) }}">
                                <i  class="material-icons">assignment</i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" class="material-icons">
                                create
                            </a>

                            <form
                                action="{{ route('products.destroy', $product) }}"
                                method="POST"
                                style="display:inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button type="submit">
                                    <i class="material-icons">delete</i>
                                </button>

                            </form>

                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>

    @else

        <p>Nenhum produto cadastrado.</p>

    @endif

    <a href="{{ route('products.create') }}">
        Cadastrar Produto
    </a>


    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
