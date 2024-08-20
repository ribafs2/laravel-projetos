Criar o método edit() no controller ProductController.php

Este método chama a view edit

Testar

Ao abrir a index clique no botão Edit na linha do registro existente

Ele abre o pqueno form com os dados. Altere algo e clique em Edit
Ele mostra
Call to undefined method App\Http\Controllers\ProductController::update() 
Isso porque a view edit é apenas o form que chhama o método update() que nosso controller ainda não tem.

Vamos criar o update()


