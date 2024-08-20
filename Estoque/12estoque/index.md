# Como criei o menu

Tenho o hábito de evitar repetições e ser sempre o mais produtivo possível.

Fiz uma cópia do header.php para header_idx.php e alterei o path do assests para o raiz.

Criei um arquivo chamado index.php

E inseri no início

<?php

require_once 'header_idx.php'

Selecionei todos os diretórios dos CRUDs e colei abaixo:

/backup/www/1Estoque/11estoque/clientes
/backup/www/1Estoque/11estoque/compra_itens
/backup/www/1Estoque/11estoque/compras
/backup/www/1Estoque/11estoque/estoques
/backup/www/1Estoque/11estoque/funcionarios
/backup/www/1Estoque/11estoque/pedido_itens
/backup/www/1Estoque/11estoque/pedidos
/backup/www/1Estoque/11estoque/produtos
/backup/www/1Estoque/11estoque/unidades

Depois selecionei o início 

e teclei Ctrl+H substituindo por nada, ou seja removendo todos os prefxos e deixando apenas os nomes dos diretórios

clientes
compra_itens
compras
estoques
funcionarios
pedido_itens
pedidos
produtos
unidades

Então criei uma tabela HTML

<table class="table">

Criei uma linha abaixo

<tr><td></td>

Então copiei <td></td> e deixei 5 células na primeira linha:

<tr><td></td><td></td><td></td><td></td><td></td></tr>

E 4 na linha abaixo:

<tr><td></td><td></td><td></td><td></td></tr>

Uma célula para cada CRUD.

Então

Criei um link 

<a href=""></a>

E copiei e colei em cada célula.

<table class="table">
<tr><td><a href=""></a></td><td><a href=""></a></td><td><a href=""></a></td><td><a href=""></a></td><td><a href=""></a></td></tr>
<tr><td><a href=""></a></td><td><a href=""></a></td><td><a href=""></a></td><td><a href=""></a></td></tr>
</table>

Agora falta apenas copiar apra cada link o nome do respectivo CRUD.

<table class="table">
<tr><td><a href="clientes">Clientes</a></td><td><a href="compra_itens">Itens de comprar</a></td><td><a href="compras">Compras</a></td><td><a href="estoques">Estoques</a></td><td><a href="funcionarios">Funcionários</a></td></tr>
<tr><td><a href="pedido_itens">Itens de pedidos</a></td><td><a href="pedidos">Pedidos</a></td><td><a href="produtos">Produtos</a></td><td><a href="unidades">Unidades</a></td></tr>
</table>

Também aproveitei para adicionar uma nova facilidade: sempre que alguém abrir um CRUD poderá voltar para o menu inicial clicando no título do CRUD, que mudei assim:

<h3><a href='../index.php'>Estoque Simplificado em PHP</a></h3>


