# StoreMarket — CRUD de Produtos

Projeto Laravel para praticar CRUD, MVC, Eloquent ORM, Blade, validações, rotas Resource, CSRF, componentes, layouts, paginação e formulários HTML.

## Objetivo

O sistema permite cadastrar, listar, visualizar, editar e excluir produtos.

Cada produto possui nome, descrição, preço e estoque.

## 1. MVC — Model, View, Controller

O projeto separa responsabilidades em três partes:

- **Model:** representa os dados e a comunicação com o banco.
- **View:** apresenta a interface ao usuário.
- **Controller:** recebe requisições e coordena o fluxo.

No projeto:


Model      -> app/Models/Product.php
Controller -> app/Http/Controllers/ProductController.php
View       -> resources/views/products/


### Por que MVC?

Evita colocar banco de dados, regras e HTML no mesmo arquivo. A separação facilita manutenção, testes, organização e evolução do sistema.

## 2. Eloquent ORM

O Laravel utiliza o **Eloquent ORM (Object-Relational Mapping)** para trabalhar com o banco através de Models.

O projeto possui:


class Product extends Model


Exemplos:


Product::paginate(4);
Product::create($request->all());
$product->update($request->all());
$product->delete();


### Por que Eloquent?

Porque reduz a necessidade de SQL manual, deixa o código mais legível e facilita operações CRUD e relacionamentos entre tabelas.

## 3. `$fillable`

No Model:

```php
protected $fillable = [
    'name',
    'price',
    'description',
    'stock'
];
```

O `$fillable` define quais atributos podem ser usados em atribuição em massa, ajudando a controlar quais campos podem ser preenchidos através de operações como `Product::create()`.

## 4. Controller e CRUD

O `ProductController` possui:


index()   -> listar
create()  -> formulário de cadastro
store()   -> salvar
show()    -> visualizar
edit()    -> formulário de edição
update()  -> atualizar
destroy() -> excluir


Essa organização corresponde às operações CRUD:


Create -> store
Read   -> index / show
Update -> update
Delete -> destroy


## 5. Route::resource()

Em routes/web.php:


Route::resource('products', ProductController::class);

Essa única declaração cria as rotas principais do CRUD(Assim, evitando que tenha que se criar uma rota para cada método):

| Método | URL | Ação |
|---|---|---|
| GET | `/products | index |
| GET | `/products/create` | create |
| POST | `/products` | store |
| GET | `/products/{product}` | show |
| GET | `/products/{product}/edit` | edit |
| PUT/PATCH | `/products/{product}` | update |
| DELETE | `/products/{product}` | destroy |

Isso evita cadastrar cada rota manualmente.

## 6. Route Model Binding

Métodos como:

```php
public function show(Product $product)
```

permitem ao Laravel localizar automaticamente o produto correspondente ao parâmetro da URL.

Isso evita repetir manualmente:

```php
Product::findOrFail($id);
```

## 7. Blade

As Views usam Blade (`.blade.php`), o sistema de templates do Laravel.

Exemplo:

```blade
{{ $product->name }}
```

O Blade permite usar dados do Controller na interface e também estruturas como `@if`, `@foreach`, `@section` e `@extends`.

## 8. `@extends`, `@yield` e `@section`

O projeto possui um layout:


resources/views/layouts/base.blade.php


Nele:


@yield('title', 'Produtos')
@yield('content')


As páginas utilizam:

```blade
@extends('layouts.base')

@section('title', 'Cadastrar Produto')

@section('content')
    ...
@endsection
```

### `@extends`

```blade
@extends('layouts.base')
```

Diz que a página deve utilizar o layout base.

### `@yield`

```blade
@yield('content')
```

Cria uma área reservada no layout.

### `@section`

```blade
@section('content')
    ...
@endsection
```

Preenche a área definida pelo `@yield`.

### Por que usar isso?

Para evitar repetir o HTML comum em todas as páginas.

Isso segue o princípio:

> **DRY — Don't Repeat Yourself**

## 9. `@csrf`

Os formulários possuem:

e

@csrf


O Laravel usa o token CSRF para proteger requisições contra **Cross-Site Request Forgery**.

Isso é especialmente importante em formulários que alteram dados.

## 10. `@method('PUT')` e `@method('DELETE')`

HTML tradicional não possui formulários com PUT e DELETE diretamente.

Por isso, na edição:


@method('PUT')


e na exclusão:


@method('DELETE')


O Laravel interpreta essas diretivas e trata as requisições com os métodos correspondentes.

## 11. `onsubmit` e `confirm()`

Na exclusão existe:


onsubmit="return confirm('Deseja realmente excluir este produto?')"


`onsubmit` é executado quando o formulário é enviado.

O `confirm()` pergunta ao usuário se ele realmente deseja excluir.

Se clicar em **OK**, o formulário continua.

Se clicar em **Cancelar**, o envio é interrompido.

### Por que utilizar?

A exclusão pode causar perda de dados. A confirmação reduz a possibilidade de exclusões acidentais.

## 12. Validações

O Controller verifica os dados recebidos:


$request->validate([
    'name' => 'required|string|max:75',
    'description' => 'nullable|string',
    'price' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
]);


As regras garantem, por exemplo:

- nome obrigatório;
- nome como texto;
- máximo de 75 caracteres;
- descrição opcional;
- preço numérico e não negativo;
- estoque inteiro e não negativo.

### Por que validar?

Para evitar que dados inválidos sejam armazenados no banco.

## 13. `@if` e `@foreach`

Para verificar se existem produtos:


@if($products->count() > 0)


Para percorrer a lista:


@foreach($products as $product)


Essas estruturas deixam a View responsável pela apresentação condicional e repetitiva dos dados.

## 14. `old()`

Nos formulários:


value="{{ old('name') }}"


O `old()` recupera valores enviados anteriormente quando ocorre uma falha de validação.

Isso melhora a experiência do usuário, pois ele não precisa preencher novamente todos os campos.

## 15. `$errors`

O Laravel disponibiliza os erros de validação através de:


$errors


Por isso podemos usar:


@if($errors->any())


e:


@foreach($errors->all() as $erro)
```

para informar ao usuário o que precisa ser corrigido.

## 16. Componente `<x-validation-errors />`

O projeto utiliza:


<x-validation-errors />


para reutilizar a apresentação dos erros.

Isso evita repetir o mesmo bloco de código nos formulários de cadastro e edição.

## 17. `session('success')`

Depois de uma operação, o Controller envia uma mensagem:


->with('success', 'Produto cadastrado com sucesso!');


A View recupera:


@if(session('success'))
    <p>{{ session('success') }}</p>
@endif


Assim o usuário recebe um retorno visual sobre o resultado da operação.

## 18. `redirect()->route()`

Após cadastrar, atualizar ou excluir, o Controller usa:


return redirect()
    ->route('products.index');


O redirecionamento pelo nome da rota é preferível a deixar a URL fixa espalhada pelo código.

## 19. Migrations

A Migration define a tabela `products`:


$table->id();
$table->string('name');
$table->text('description')->nullable();
$table->decimal('price', 10, 2);
$table->integer('stock')->default(0);
$table->timestamps();


Migrations permitem versionar a estrutura do banco junto com o código.

## 20. Paginação

O Controller utiliza:


Product::paginate(4);


Assim são exibidos quatro produtos por página.

Na View:


{{ $products->links() }}


gera os links de navegação.

A paginação evita carregar uma quantidade muito grande de registros de uma só vez.

## 21. Materialize CSS

O projeto utiliza Materialize CSS para fornecer componentes visuais e Material Icons.

Exemplo:


<i class="material-icons">delete</i>


Isso permite melhorar a interface sem precisar criar todo o CSS manualmente.

## 22. Fluxo geral da aplicação


Usuário
   ↓
Rota
   ↓
ProductController
   ↓
Validação
   ↓
Product / Eloquent
   ↓
Banco de dados
   ↓
Controller
   ↓
Blade View
   ↓
Usuário


## 23. Estrutura


app/
├── Http/
│   └── Controllers/
│       └── ProductController.php
└── Models/
    └── Product.php

database/
└── migrations/
    └── create_products_table.php

resources/
└── views/
    ├── components/
    │   └── validation-errors.blade.php
    ├── layouts/
    │   └── base.blade.php
    └── products/
        ├── create.blade.php
        ├── edit.blade.php
        ├── index.blade.php
        └── show.blade.php

routes/
└── web.php


## 24. Resumo

| Recurso | Motivo |
|---|---|
| MVC | Separar responsabilidades |
| Eloquent ORM | Facilitar acesso ao banco |
| Model | Representar produtos |
| Controller | Controlar requisições |
| Blade | Criar as Views |
| `@extends` | Reutilizar layout |
| `@yield` | Criar áreas do layout |
| `@section` | Preencher áreas do layout |
| `@csrf` | Proteger formulários |
| `@method` | Permitir PUT/DELETE |
| `onsubmit` | Executar ação no envio |
| `confirm()` | Confirmar exclusão |
| `@if` | Condições na View |
| `@foreach` | Percorrer produtos |
| `old()` | Preservar dados do formulário |
| `$errors` | Mostrar erros |
| `$fillable` | Controlar atribuição em massa |
| `Route::resource()` | Criar rotas CRUD |
| Route Model Binding | Localizar Models automaticamente |
| Migration | Versionar estrutura do banco |
| Paginação | Evitar listas muito grandes |
| Componentes Blade | Reutilizar código |
| `redirect()->route()` | Redirecionar por nome de rota |
| Session flash | Mostrar mensagens de resultado |

## Conclusão

A organização do projeto busca demonstrar não apenas como fazer um CRUD funcionar, mas como construir uma aplicação Laravel com responsabilidades separadas.

Cada recurso foi utilizado com uma finalidade: o **MVC** organiza a arquitetura, o **Eloquent** facilita o acesso ao banco, o **Blade** organiza as Views, `@yield` e `@section` evitam repetição, `onsubmit` e `confirm()` protegem contra exclusões acidentais, e as validações ajudam a garantir a qualidade dos dados.
