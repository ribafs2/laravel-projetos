Criar o método create() no controller ProductController

Adicionar a view create.blade.php ao resources/views/products

Testar

Ao abrir a index clique no botão Add New

Veja quue ele abre o form, mas o create é apenas o form. Caso preencha os dados e clique em Create ele vai informar
Call to undefined method App\Http\Controllers\ProductController::store() 

Ou seja, não encontrou o método store() que processaria os dados.

Nossa próxima etapa.

