DELIMITER //
CREATE TRIGGER `TRG_SaidaProduto_AU` AFTER UPDATE ON `vendas`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, old.qtde - new.qtde, new.valor_unitario);
END //
DELIMITER ;
