# Controle de Estoque Simplificado em PHP do "zero"

Partindo de um pequeno script de paginação que usa o plugin do jQuery bootpag.

## Nesta fase

Resolvi usar um modelo simples de banco de dados, com apenas 4 tabelas, pois o objetivo é mostrar as operações de um controle de estoque simplificado e este resolve.

## Cada compra

- Será adicionada também ao estoque atual. O estoque tem os campos: compra_id, quantidade e valor_unitario. Quando cadastramos uma compra, ela tem os campos de estoques, esceto compra_id, mas o id de compras é o compra_id.
- Verifica antes de cadastrar a compra se a quantidade em estoque é maior que o estoque_maximo em produtos e alerta caso seja maior

## Cada venda

- Será reduzida do estoque
- Verifica antes de cadastrar a venda se a quantidade em estoque é menor que o estoque_minimo em produtos e alerta caso fique menor

## Suporte ao PostgreSQL

Também criei um script sql compatível com o SGBD PostgreSQL para mais a frente usar nosso controle de estoque com PostgreSQL também.

Já preparei o código para usar o banco com PostgreSQL. A única diferença apra suportar PostgreSQL é a linha com LIMIT no fetch_data.php:

$results = $pdo->prepare("SELECT * FROM clientes ORDER BY id LIMIT $start, $row_limit");

Então criei uma variável $sgbd no connect.php que conterá o SGBD, mysql ou pgsql e usei no fetch_data.php:

if($sgbd == 'mysql'){
    $results = $pdo->prepare("SELECT * FROM clientes ORDER BY id LIMIT $start, $row_limit");
}elseif($sgbd == 'pgsql'){
    $results = $pdo->prepare("SELECT * FROM clientes ORDER BY id LIMIT $row_limit OFFSET $start");
}

Agora para usar o banco no PostgreSQL basta trocar o SGBD no connect.php e os demais dados do banco.

## Estoque com CakePHP

Após encerrar esta fase, estava planejando criar uma versão em PHP Orientado a Objetos, mas mudei de ideia e criarei de uma forma muito mais produtiva, usarei o CakePHP com seu maravilhoso bake, que cria cada cRUD com apenas um comando mas com muitas outras vantagens. Os campos relacionados já vem com uma combo preenchida da tabela relacionada. Por padrão ele traz o ID da tabela relacionada neste campo, mas basta uma rápida configuração e ele mostra o campo descrição ao invés. 

Não conheço nada igual em termos de produtividade e eficiẽncia.

## Tipos de tabelas

Vamos dividir as tabelas em primárias e secundárias.

## As tabelas primárias

São aquelas que todos os seus campos nascem na própria tabela e não dependem de nenhuma outra. Exemplos: clientes, funcionarios, unidades, compras e produtos.

## As tabelas secundárias

São as tabelas que contém alguns campos que se relacionam com outras tabelas e assim contém foreign keys. Exemplos: compra_itens, estoques, pedidos e pedido_itens

Veja o gráfico (DER - Diagrama Entidades Relacionamentos) na pasta db/estoque.png.

## Na fase anterior

Na fase anterior implementamos todos os CRUDs, mas não criamos um menu que possa chaamr cada um, precisamos entrar com a URL de cada um para poder acessar.
Agora vamos criar um menu no index.php no raiz, com links para cada CRUD.

Veja aqui

[index.md](index.md)

Como criei o arquivo index.php

## Controle de Estoque Valendo

Um controle de estoque valendo tem muitas tabelas e características a mais: empresas, clientes, vendedores, representantes, comrpa_itens, venda_itens, armazens, bonus, unidades, etc. 

É importante criar uma tabela de produtos e para cada um esepcificar o estoque_minimo e estoque_maximo específico. Estamos criando um aplicativo de testes, mas na vida real isso baseia-se na capacidade de repor o estoque (estoque_minimo) e na capacidade de armazenar cada produto (estoque_maximo).

## Na fase anterior

Estarei iniciando o aplicativo controle de estoque propriamente dito. Nosso controle de estoque simplificado contará com as tabelas:

- clientes
- funcionarios
- unidades
- produtos
- compras
- produtos
- compra_itens
- estoques
- pedidos
- pedido_itens

Estarei removendo a tabela customers e inserindo as acima com registros.

Algumas relacionadas, mas este não é o foco, mesmo que os relacionamentos sejam muito importantes, aqui queremos mostrar o funcionamento de um controle de estoque simples usando PHP.

Nesta primeira faze estarei criando um crud para cada tabela usando o customers como base. Não testarei abordando detalhes, pois estes já foram abordados.
Agora usarei os arquivos: index.php, fetch_data.php, add.php, update.php, delete.php e search.php em cada CRUD. Os demais ficaram no raiz: assets, connect.php, footer.php e header.php.

Nesta fase não estarei tratando as mensagens de erro, que deverão ser entendidas por nós, em especial os registros nas tabelas realcionadas.

Ao final estarei tratando as mensagens para mostrar mensagens que usuários entendam.

## Importante

O header.php é incluído no index.php. Como o header.php está no raiz, assim como a pasta assets, não deveria isar ../assets, mas como foi incluído pelo index.php, então seu código fica no nivel do index.php, portanto precisa user ../assets. Fique atento para isso. Realmente melhor que usar includes é usar namespaces, mas se usar includes é bom ficar atento.

## Na fase anterior

Estarei adicionando os arquivos update.php e delete.php assim como as respectivas chamadas no fetch_data.php. Depois de adicionar o de.ete.php estarei usando o confirm do javascript para remover os registros sem usar o delete.php

Com isso dow o CRUD por concluído e agora vamos partir para o Controle de Estoque propriamente dito. Também aqui iremos bem devagar, passo-a-passo, para facilitar o entendimento.

## Ne fase anterior

Para isso farei algumas alterações no index.php e no fetch_data.php e adicionarei os arquivos update.php e o delete.php. Existe uma opção de usar no index.php um confirm do javascript e dependendo da escolha do usuário já remover o registro, sem a necessidade de mostrar este pedido de confirmação em um arquivo. Eu prefiro isso, mas vou mostrar as duas formas.

Veja:
```
	    <td><a href="delete.php?id=<?=$row['id']?>"><i class="glyphicon glyphicon-remove-circle" title="Excluir"></a></td>
//ou
        <td><a onclick="return confirm('Realmente excluir o cliente <?=$name?> ?')" href="delete.php?id=<?=$id?>&table=<?=$table?>"><i class="glyphicon glyphicon-remove-circle" title="Delete"></a></td></tr>
```

Renomeei o db_connect.php para connect.php

## Um milhão de registros

Nesta fase resolvi gerar um script .sql com um milhão de registros, que gastou uns 15 minutos no meu notebook i5, com 8GB de RAM.

Tive que configurar o MariaDb assim:

https://github.com/professor/Backend/SGBD/MySQL/mysql_import_bigs.txt

O sql ficou com 74.4 MB.

Pra importar não demorou quase nada:

mysql -uroot estoque < db.sql

Esta plugin é ótimo, pois agora testando com um milhão de regsitros não percebo que ficou mais lento.


## Na fase anterior

Adicionarei a busca, implementando o botão e a caixa de texto no index.php e o arquivo search.php.

## Frontend

Observe que não estou comentando sobre o código do frontend. Realmente o bootstrap facilita muito este trabalho, por isso que o utilizo, visto que meu foco pra valer é no backend, mas é importante observar como ele funciona. Por conta disso adicionei um um pequeno tutorial sobre as classes do bootstrap usadas neste projeto. Lembre que a versão que usei foi a 3, apenas segui a usada no projeto original da paginação. Para adaptar para a versão 5 precisa fazer algumas poucas adaptações.

## Na fase anterior

Iniciei a criação do CRUD partindo da paginação, que já traz a primeira parte do cRUD, que é a listagem, formada pelo index.php e o fetch_data.php

Adicionarei os respectivos botões no index.php para: add.php, update.php e delete.php. Também estarei adicionando a busca (search.php).

## Na fase anterior

Estarei criando os arquivos header.php e footer.php que serão incluídos em todas as páginas tipo view, onde eles aparecem.

Importante em termos de reutilização de código, pois ao invés de repetir o código do cabeçalho e rodapé nas páginas, estaremos apenas incluindo. Isto facilita e muito a manutenção do aplicativo. Caso encessitemos alterar o código nestas regiões alteraremos apenas uma vez no arquivo (header ou footer) e ele será atualizado automaticamente em todas as páginas em que são incluídos.

## Na fase anterior

Agora estarei apenas organizando melhor as pastas:

- Criarei uma pasta chamada 'assets' e moverei para ela as pastas css, fonts e js

Na próxima fase criarei um CRUD

## Na fase anterior

Melhorei a paginação, seguindo um exemplo do site oficial do bootpag (Full example com todos os recursos dispíveis. Troquei as setas pelas palavras: Primeira e Última)

https://botmonster.com/jquery-bootpag/

Aproveitei e criei um fork do mesmo, para apoiá-lo e para manter uma cópia do mesmo por perto.

Bons recursos

Parameters $(element).bootpag({...})

    - total number of pages
    - maxVisible maximum number of visible pages
    - page page to show on start
    - leaps next/prev buttons move over one page or maximum visible pages
    - next text (default »)
    - prev text (default «)
    - href template for pagination links (default javascript:void(0);)
    - hrefVariable variable name in href template for page number (default {{number}})
    - firstLastUse do we ant first and last (default true<)/li>
    - first name of first (default 'FIRST')
    - last name of last (default 'LAST')
    - wrapClass css class for wrap (default 'pagination')
    - activeClass css class for active (default 'active')
    - disabledClass css class for disabled (default 'disabled')
    - nextClass css class for next (default 'next')
    - prevClass css class for prev (default 'prev')
    - lastClass css class for last (default 'last')
    - firstClass css class for first (default 'first')

Events available on bootpag object

    - page on page click
    - callback params:
         - event object
         - num page number clicked


## Na fase anterior

Apenas criei a paginação partindo do tutorial original do kodingmadesimple

Crédito pela paginação
https://www.kodingmadesimple.com/2017/01/simple-ajax-pagination-in-jquery-php-pdo-mysql.html

