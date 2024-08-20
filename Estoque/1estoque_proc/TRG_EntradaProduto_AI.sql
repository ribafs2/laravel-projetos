DELIMITER //
CREATE TRIGGER `TRG_EntradaProduto_AI` AFTER INSERT ON `compras`
FOR EACH ROW
BEGIN
      CALL SP_AtualizaEstoque (new.id_produto, new.qtde, new.valor_unitario);
END //
DELIMITER ;

