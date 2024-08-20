CREATE TYPE enum AS ENUM ('KG', 'UN', 'L');

create table produtos(
    id serial primary key,
    descricao varchar(50) UNIQUE not null,
    unidade enum DEFAULT 'KG' not null,    
    estoque_minimo int NULL DEFAULT NULL,
    estoque_maximo int NULL DEFAULT NULL
);

create table compras(
    id serial primary key,
    produto_id INT NULL DEFAULT NULL,
    quantidade INT NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
    data DATE NULL DEFAULT NULL,
	constraint compra_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE estoques (
    id serial primary key,
    produto_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
	constraint estoque_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE vendas (
    id serial primary key,
    produto_id INT NOT NULL,
    quantidade INT NULL DEFAULT NULL,
    data DATE NULL DEFAULT NULL,
    valor_unitario DECIMAL(9,2) NULL DEFAULT '0.00',
	constraint venda_fk foreign key (produto_id) references produtos(id) ON DELETE CASCADE ON UPDATE CASCADE
);

Referências
https://www.devmedia.com.br/implementando-controle-de-estoque-no-mysql-com-triggers-e-procedures/26352

