Inicialmente criar

migration
model
rota

php artisan make:migration create_products_table
php artisan make:model Product

Route::resource('/products', 'App\Http\Controllers\ProductController');

Primeira fase

Criar o controller ProductController

php artisan make:controller ProductController

então criar método index()

Adicionar a view index.blade.php ao resources/views/products

php artisan make:view products.index

Testar

Ao abrir a index verá a listagem dos registros da tabela

Nossa próxima etapa será o create

