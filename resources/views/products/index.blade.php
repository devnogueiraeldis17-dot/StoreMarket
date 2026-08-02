@extends('layouts.base')

@section('content')
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

                            <a href="{{ route('products.show', $product) }}" title="Visualizar">
                                <i  class="material-icons">assignment</i>
                            </a>
                            <a href="{{ route('products.edit', $product) }}" title="Editar" class="material-icons">
                                edit
                            </a>

                            <form
                                action="{{ route('products.destroy', $product) }}"
                                method="POST"
                                style="display:inline"  onsubmit="return confirm('Deseja realmente excluir este produto?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button type="submit" title="Excluir">
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

    <!--Link para paginação-->
    <span style="text-align:center;">{{$products->links()}}</span>

    <a href="{{ route('products.create') }}">
        Cadastrar Produto
    </a>
@endsection
