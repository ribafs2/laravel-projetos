composer require laravel/breeze --dev

php artisan breeze:install
 
php artisan migrate
npm install
npm run dev

Breeze e Blade

A "pilha" padrão do Breeze é a pilha Blade, que utiliza modelos Blade simples para renderizar o frontend do seu aplicativo. A pilha Blade pode ser instalada invocando o comando breeze:install sem outros argumentos adicionais e selecionando a pilha frontend Blade. 

php artisan serve

http://127.0.0.1:8000

Em seguida, você pode navegar para as URLs /login ou /register do seu aplicativo no seu navegador da web. Todas as rotas do Breeze são definidas dentro do arquivo routes/auth.php.
