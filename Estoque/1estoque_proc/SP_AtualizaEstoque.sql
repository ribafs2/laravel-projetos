DELIMITER //
  CREATE PROCEDURE `SP_AtualizaEstoque`( `id_prod` int, `qtde_comprada` int, valor_unit decimal(9,2))
BEGIN
    declare contador int(11);

    SELECT count(*) into contador FROM estoques WHERE id_produto = id_prod;

    IF contador > 0 THEN
        UPDATE estoques SET qtde=qtde + qtde_comprada, valor_unitario= valor_unit
        WHERE id_produto = id_prod;
    ELSE
        INSERT INTO estoques (id_produto, qtde, valor_unitario) values (id_prod, qtde_comprada, valor_unit);
    END IF;
END //
DELIMITER ;


