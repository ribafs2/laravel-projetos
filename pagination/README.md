Paginação de r esuktados no laravel 11

Paginação de Resultados no Laravel 11

Em outras estruturas, a paginação pode ser muito dolorosa. Esperamos que a abordagem do Laravel para paginação seja uma lufada de ar fresco. O paginador do Laravel é integrado ao query builder e ao Eloquent ORM e fornece paginação conveniente e fácil de usar de registros de banco de dados com configuração zero.

Por padrão, o HTML gerado pelo paginador é compatível com a estrutura Tailwind CSS; no entanto, o suporte à paginação Bootstrap também está disponível.

Paginando Resultados do Query Builder

Existem várias maneiras de paginar itens. A mais simples é usar o método paginate no query builder ou uma consulta Eloquent. O método paginate cuida automaticamente da configuração do "limit" e "offset" da consulta com base na página atual que está sendo visualizada pelo usuário. Por padrão, a página atual é detectada pelo valor do argumento da string de consulta da página na solicitação HTTP. Esse valor é detectado automaticamente pelo Laravel e também é inserido automaticamente em links gerados pelo paginador.

composer create-project laravel/laravel pagination

cd pagination

Configurar banco no .env

php artisan migrate

Gerar 100 registros de teste com tinker e factory

php artisan tinker

User::factory()->count(100)->create()

Adicionar rota

Route::get('users', [UserController::class, 'index']);

Criar controller

app/Http/Controllers/UserController.php

<?php
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
  
class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::paginate(5);  
        return view('users', compact('users'));
    }
}

Criar

resources/views/users.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Paginação de Resultados no Laravel</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Paginação de Resultados no Laravel</h1>
    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">There are no users.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {!! $users->withQueryString()->links('pagination::bootstrap-5') !!}
</div> 
</body>
</html>

php artisan serve

http://localhost:8000/users

https://www.itsolutionstuff.com/post/laravel-10-pagination-example-tutorialexample.html

Agora vamos traduzir as palavras da paginação

Editar
vendor\laravel\framework\src\elluminate\Pagination\resources\views\bootstrap-5.blade.php

Showing - Mostrando
to - até
of - de
results - resultados


Paginando resultados do Eloquent

Você também pode paginar consultas do Eloquent. Neste exemplo, paginaremos o modelo App\Models\User e indicaremos que planejamos exibir 15 registros por página. Como você pode ver, a sintaxe é quase idêntica à paginação de resultados do construtor de consultas:

use App\Models\User;

$users = User::paginate(15);

É claro que você pode chamar o método paginate após definir outras restrições na consulta, como cláusulas where:

$users = User::where('votes', '>', 100)->paginate(15);

Você também pode usar o método simplePaginate ao paginar modelos do Eloquent:

$users = User::where('votes', '>', 100)->simplePaginate(15);

Da mesma forma, você pode usar o método cursorPaginate para paginar modelos Eloquent com cursor:

$users = User::where('votes', '>', 100)->cursorPaginate(15);

Exibindo resultados de paginação

Ao chamar o método paginate, você receberá uma instância de Illuminate\Pagination\LengthAwarePaginator, enquanto chamar o método simplePaginate retorna uma instância de Illuminate\Pagination\Paginator. E, finalmente, chamar o método cursorPaginate retorna uma instância de Illuminate\Pagination\CursorPaginator.

Esses objetos fornecem vários métodos que descrevem o conjunto de resultados. Além desses métodos auxiliares, as instâncias do paginador são iteradores e podem ser colocadas em loop como uma matriz. Então, depois de recuperar os resultados, você pode exibi-los e renderizar os links de página usando o Blade:

<div class="container">
@foreach ($users as $user)
{{ $user->name }}
@endforeach
</div>

{{ $users->links() }}

O método links renderizará os links para o restante das páginas no conjunto de resultados. Cada um desses links já conterá a variável de string de consulta de página adequada. Lembre-se, o HTML gerado pelo método links é compatível com o framework Tailwind CSS.

Personalizando a Visualização de Paginação

Por padrão, as visualizações renderizadas para exibir os links de paginação são compatíveis com a estrutura Tailwind CSS. No entanto, se você não estiver usando o Tailwind, você está livre para definir suas próprias visualizações para renderizar esses links. Ao chamar o método links em uma instância do paginador, você pode passar o nome da visualização como o primeiro argumento para o método:

{{ $paginator->links('view.name') }}

<!-- Passando dados adicionais para a visualização... -->
{{ $paginator->links('view.name', ['foo' => 'bar']) }}

No entanto, a maneira mais fácil de personalizar as visualizações de paginação é exportando-as para seu diretório resources/views/vendor usando o comando vendor:publish:

php artisan vendor:publish --tag=laravel-pagination

Este comando colocará as visualizações no diretório resources/views/vendor/pagination do seu aplicativo. O arquivo tailwind.blade.php dentro deste diretório corresponde à visualização de paginação padrão. Você pode editar este arquivo para modificar o HTML de paginação.

Se você quiser designar um arquivo diferente como a visualização de paginação padrão, você pode invocar os métodos defaultView e defaultSimpleView do paginador dentro do método boot da sua classe 
App\Providers\AppServiceProvider:

<?php
namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
	public function boot(): void
	{
		Paginator::defaultView('view-name');
		Paginator::defaultSimpleView('view-name');
	}
}
Usando Bootstrap

O Laravel inclui visualizações de paginação construídas usando Bootstrap CSS. Para usar essas visualizações em vez das visualizações padrão do Tailwind, você pode chamar os métodos useBootstrapFour ou useBootstrapFive do paginador dentro do método boot da sua classe App\Providers\AppServiceProvider:

use Illuminate\Pagination\Paginator;

public function boot(): void
{
	Paginator::useBootstrapFive();
	Paginator::useBootstrapFour();
}
