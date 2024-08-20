O Laravel 11 fornece um objeto de request/solicitação para adicionar validação de formulário usando-o. Usaremos request validate() para adicionar regras de validação e mensagens personalizadas. Usaremos a variável $errors para exibir mensagens de erro.

composer create-project laravel/laravel errors-msg

cd errors-msg

php artisan make:controller FormController

app/Http/Controllers/FormController.php

<?php 
namespace App\Http\Controllers;
      
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
     
class FormController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('createUser');
    }
          
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
                'name' => 'required',
                'password' => 'required|min:5',
                'email' => 'required|email|unique:users'
            ], [
                'name.required' => 'Name field is required.',
                'password.required' => 'Password field is required.',
                'email.required' => 'Email field is required.',
                'email.email' => 'Email field must be email address.'
            ]);
        
        $validatedData['password'] = bcrypt($validatedData['password']);
        $user = User::create($validatedData);
              
        return back()->with('success', 'User created successfully.');
    }
}

routes/web.php

<?php
  
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\FormController;
  
Route::get('users/create', [ FormController::class, 'create' ]);
Route::post('users/create', [ FormController::class, 'store' ])->name('users.store');

resources/views/createUser.blade.php

<!DOCTYPE html>
<html>
<head>
    <title>Laravel 11 Form Validation Example - ItSolutionStuff.com</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>
<body>
<div class="container">
  
    <div class="card mt-5">
        <h3 class="card-header p-3"><i class="fa fa-star"></i> Laravel 11 Form Validation Example - ItSolutionStuff.com</h3>
        <div class="card-body">
            @session('success')
                <div class="alert alert-success" role="alert"> 
                    {{ $value }}
                </div>
            @endsession
          
            <!-- Way 1: Display All Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
             
            <form method="POST" action="{{ route('users.store') }}">
            
                {{ csrf_field() }}
            
                <div class="mb-3">
                    <label class="form-label" for="inputName">Name:</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="inputName"
                        class="form-control @error('name') is-invalid @enderror" 
                        placeholder="Name">
      
                    <!-- Way 2: Display Error Message -->
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
           
                <div class="mb-3">
                    <label class="form-label" for="inputPassword">Password:</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="inputPassword"
                        class="form-control @error('password') is-invalid @enderror" 
                        placeholder="Password">
      
                    <!-- Way 3: Display Error Message -->
                    @if ($errors->has('password'))
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    @endif
                </div>
             
                <div class="mb-3">
                    <label class="form-label" for="inputEmail">Email:</label>
                    <input 
                        type="text" 
                        name="email" 
                        id="inputEmail"
                        class="form-control @error('email') is-invalid @enderror" 
                        placeholder="Email">
      
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @endif
                </div>
           
                <div class="mb-3">
                    <button class="btn btn-success btn-submit"><i class="fa fa-save"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>

php artisan serve

http://localhost:8000/users/create

Efetue alguns testes
Apenas Enter ou clique em /submit sem digitar nada

https://www.itsolutionstuff.com/post/laravel-11-custom-validation-error-message-exampleexample.html

Traduzindo as mensagens

As mensagens originais estão no método store() do controller:

Exemplo:

Name field is required - O campo name é obrigatório

