<?php require_once('../header.php'); ?>
<style>

</style>
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <form method="post" action="">
                <table class="table table-bordered table-responsive table-hover">

<?php
require_once('../connect.php');

$id=$_GET['id'];

$sth = $pdo->prepare("SELECT id, produto_id, quantidade, data,valor_unitario from vendas WHERE id = :id");
$sth->bindValue(':id', $id, PDO::PARAM_STR); // No select e no delete basta um bindValue
$sth->execute();

$reg = $sth->fetch(PDO::FETCH_OBJ);

$id = $reg->id;
$produto_id = $reg->produto_id;
$quantidade = $reg->quantidade;
$data = $reg->data;
$valor_unitario = $reg->valor_unitario;
?>

   <h3>Vendass</h3>
   <tr><td>ID Produto</td><td><input name="produto_id" type="text" value="<?=$produto_id?>"></td></tr>
   <tr><td>Quantidade</td><td><input name="quantidade" type="text" value="<?=$quantidade?>"></td></tr>
   <tr><td>Data</td><td><input name="data" type="text" value="<?=$data?>"></td></tr>
   <tr><td>Valor unitário</td><td><input name="valor_unitario" type="text" value="<?=$valor_unitario?>"></td></tr>
   <tr><td></td><td><input name="enviar" class="btn btn-primary" type="submit" value="Editar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <input name="id" type="hidden" value="<?=$id?>">
   <input name="enviar" class="btn btn-warning" type="button" onclick="location='index.php'" value="Voltar"></td></tr>
       </table>
        </form>
        </div>
    <div>
</div>
<?php

if(isset($_POST['enviar'])){
    $id = $_POST['id'];
    $produto_id = $_POST['produto_id'];
    $quantidade = $_POST['quantidade'];
    $data = $_POST['data'];
    $valor_unitario = $_POST['valor_unitario'];

    $data = [
        'produto_id' => $produto_id,
        'quantidade' => $quantidade,
        'data' => $data,
        'valor_unitario' => $valor_unitario,
        'id' => $id,
    ];

    $sql = "UPDATE vendas SET produto_id=:produto_id, quantidade=:quantidade, data=:data, valor_unitario=:valor_unitario WHERE id=:id";
    $stmt= $pdo->prepare($sql);

   if($stmt->execute($data)){
        print "<script>alert('Registro alterado com sucesso!');location='index.php';</script>";
    }else{
        print "Erro ao editar o registro!<br><br>";
    }
}
require_once('../footer.php');
?>

