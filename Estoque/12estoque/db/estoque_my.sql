create table produtos(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    descricao varchar(50) UNIQUE not null,
    unidade enum('KG', 'UN', 'L') DEFAULT 'KG' not null,    
    estoque_minimo int NULL DEFAULT NULL,
    estoque_maximo int NULL DEFAULT NULL
);

create table compras(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    produto_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
    data DATE NULL DEFAULT NULL,
	constraint compra_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE estoques (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    compra_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
	constraint estoque_fk foreign key (compra_id) references compras(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vendas (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    produto_id INT NOT NULL,
    estoque_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    data DATE NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
	constraint venda_fk foreign key (estoque_id) references estoques(id) ON DELETE CASCADE ON UPDATE CASCADE
);

Referências
https://www.devmedia.com.br/implementando-controle-de-estoque-no-mysql-com-triggers-e-procedures/26352

