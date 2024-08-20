DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AD` AFTER DELETE ON `compras`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (old.id_produto, old.qtde * -1, old.valor_unitario);
END //
DELIMITER ;
