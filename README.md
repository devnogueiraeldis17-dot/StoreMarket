StoreMarket
Sistema de gerenciamento de produtos desenvolvido com Laravel, utilizando PHP, PostgreSQL, Blade, Eloquent ORM e Materialize CSS.
O projeto foi desenvolvido com objetivo de praticar a criação de um CRUD completo no Laravel.

📋 Sobre o projeto
O StoreMarket é um sistema simples para gerenciamento de produtos.
A aplicação permite realizar as principais operações de um CRUD:
Criar produtos
Listar produtos
Visualizar detalhes de um produto
Editar produtos
Excluir produtos
Validar informações
Exibir mensagens de sucesso
Utilizar banco de dados PostgreSQL

🚀 Tecnologias utilizadas
PHP
Laravel
Laravel Blade
Eloquent ORM
PostgreSQL
Materialize CSS
HTML5
CSS3

📦 Funcionalidades
Cadastro de produtos
É possível cadastrar um produto informando:
Nome
Descrição
Preço
Estoque
Listagem
A página principal apresenta todos os produtos cadastrados.
São exibidas as informações:
ID
Nome
Preço
Estoque
Também existem ações para:
Visualizar
Editar
Excluir
Visualização
É possível visualizar os detalhes de um produto individualmente.
Edição
Os dados de um produto existente podem ser alterados.
Exclusão
Um produto pode ser removido do banco de dados.

🗂️ Estrutura principal
A estrutura utilizada no projeto segue o padrão MVC do Laravel:
storeMarket/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProductController.php
│   │
│   └── Models/
│       ├── Product.php
│       └── User.php
│
├── database/
│   └── migrations/
│
├── resources/
│   └── views/
│       └── products/
│           ├── create.blade.php
│           ├── edit.blade.php
│           ├── index.blade.php
│           └── show.blade.php
│
├── routes/
│   └── web.php
│
├── .env
├── artisan
├── composer.json
└── README.md

🧩 Arquitetura MVC
O projeto utiliza o padrão MVC (Model-View-Controller).
                    NAVEGADOR
                        │
                        ▼
                      ROUTES
                   routes/web.php
                        │
                        ▼
                   CONTROLLER
              ProductController.php
                        │
                        ▼
                     MODEL
                   Product.php
                        │
                        ▼
                   PostgreSQL
                        │
                        ▼
                      VIEW
                Blade / HTML
                        │
                        ▼
                    NAVEGADOR
Model
O Model responsável pelos produtos é:
app/Models/Product.php
Ele utiliza o Eloquent ORM para trabalhar com o banco de dados.
Os campos permitidos para preenchimento são:
protected $fillable = [
    'name',
    'price',
    'description',
    'stock'
];
Controller
O Controller está localizado em:
app/Http/Controllers/ProductController.php
Ele possui os métodos responsáveis pelas operações do CRUD:
index()
create()
store()
show()
edit()
update()
destroy()
Views
As Views estão localizadas em:
resources/views/products/
Arquivos:
create.blade.php
edit.blade.php
index.blade.php
show.blade.php

🛣️ Rotas
O projeto utiliza Route::resource():
Route::resource('products', ProductController::class);
Essa única declaração cria as rotas necessárias para o CRUD.
Método
URL
Controller
Função
GET
/products
index
Lista produtos
GET
/products/create
create
Formulário de cadastro
POST
/products
store
Salva produto
GET
/products/{product}
show
Exibe produto
GET
/products/{product}/edit
edit
Formulário de edição
PUT/PATCH
/products/{product}
update
Atualiza produto
DELETE
/products/{product}
destroy
Exclui produto

Para visualizar todas as rotas:
php artisan route:list

📝 Validação
Os dados são validados no ProductController.
$request->validate([
    'name' => 'required|string|max:75',
    'description' => 'nullable|string',
    'price' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
]);
Regras
Nome
required
string
max:75
O nome é obrigatório e pode possuir no máximo 75 caracteres.
Descrição
nullable|string
A descrição é opcional.
Preço
required|numeric|min:0
O preço:
É obrigatório
Deve ser numérico
Não pode ser negativo
Estoque
required|integer|min:0
O estoque:
É obrigatório
Deve ser um número inteiro
Não pode ser negativo

🗄️ Banco de dados
O projeto utiliza PostgreSQL.
Configuração utilizada no .env:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=storeMarket
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
Não compartilhe sua senha real do banco de dados em um repositório público.
Crie o banco de dados:
storeMarket
Depois execute:
php artisan migrate

⚙️ Instalação
1. Clonar o projeto
git clone URL_DO_REPOSITORIO
Entre na pasta:
cd storeMarket
2. Instalar dependências
composer install
3. Criar o arquivo .env
No Windows, copie:
.env.example
para:
.env
No terminal também pode ser utilizado:
copy .env.example .env
4. Gerar a chave da aplicação
php artisan key:generate
5. Configurar o banco
Edite o arquivo:
.env
e configure o PostgreSQL:
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=storeMarket
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
6. Executar as migrations
php artisan migrate
7. Iniciar o servidor
php artisan serve
Acesse no navegador:
http://127.0.0.1:8000
A rota / redireciona automaticamente para:
http://127.0.0.1:8000/products

🎨 Materialize CSS
O projeto utiliza o Materialize CSS para estilização da interface.
O CSS é carregado através de CDN:
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"
>
Os ícones do Material Icons também são utilizados:
<link
    href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet"
>

🔐 Proteção dos formulários
Os formulários utilizam proteção CSRF através do Blade:
@csrf
Para atualizar um produto:
@method('PUT')
Para excluir:
@method('DELETE')
Isso permite que o Laravel trate corretamente os métodos HTTP utilizados pelo CRUD.

🔄 Funcionamento do CRUD
Criar
Formulário
    ↓
POST /products
    ↓
ProductController@store
    ↓
Validação
    ↓
Product::create()
    ↓
PostgreSQL
Listar
GET /products
    ↓
ProductController@index
    ↓
Product::all()
    ↓
products.index
    ↓
Lista de produtos
Visualizar
GET /products/{product}
    ↓
ProductController@show
    ↓
Product Model
    ↓
products.show
Editar
GET /products/{product}/edit
    ↓
ProductController@edit
    ↓
products.edit
    ↓
PUT /products/{product}
    ↓
ProductController@update
    ↓
$product->update()
Excluir
DELETE /products/{product}
    ↓
ProductController@destroy
    ↓
$product->delete()
    ↓
PostgreSQL

🧰 Comandos úteis
Iniciar servidor:
php artisan serve
Ver rotas:
php artisan route:list
Criar Model:
php artisan make:model Product
Criar Model com Migration:
php artisan make:model Product -m
Criar Controller Resource:
php artisan make:controller ProductController --resource
Executar migrations:
php artisan migrate
Ver status das migrations:
php artisan migrate:status
Limpar caches:
php artisan optimize:clear

⚠️ Atenção ao .env
O arquivo .env contém informações sensíveis, principalmente:
DB_USERNAME=postgres
DB_PASSWORD=sua_senha
Não coloque o .env no GitHub.
O .gitignore do Laravel normalmente já contém:
.env
.env.backup
.env.production
O repositório deve utilizar:
.env.example
como modelo de configuração.

🎯 Objetivo do projeto
O objetivo do StoreMarket é praticar conceitos fundamentais do desenvolvimento web com Laravel:
MVC
Rotas
Controllers
Models
Eloquent ORM
Migrations
PostgreSQL
Blade
Forms
Validação
CRUD
Route Model Binding
Materialize CSS
Proteção CSRF

👨‍💻 Autor
Eldis Nogueira

Projeto desenvolvido para fins de estudo e prática com Laravel.
