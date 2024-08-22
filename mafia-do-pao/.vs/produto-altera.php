<?php
include('conectadb.php');
include('topo.php');

// Preenchimento dos campos
$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while($tbl = mysqli_fetch_array($retorno)){
    $nomeproduto = $tbl[1];
    $quantidade = $tbl[2];
    $unidade = $tbl[3];
    $preco = $tbl[4];
    $status = $tbl[5];
    $imagem = $tbl[6];

}

?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="./javaScript.js"></script>
    <title>ALTERAÇÃO DE PRODUTO</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>
<body >
    
    <div class="container-global">
       <a href="produto-lista.php" height="0px" style="margin: 400px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
        <form class="formulario" action="produto-altera.php" method="post" enctype="multipart/form-data">
       
        <label>NOME PRODUTO</label>
            <input type="text" id="txtnomeproduto" name="txtnomeproduto" placeholder="DIGITE O NOME DO PRODUTO" value="<?=$nomeproduto?>" required>
            <br>
            <label>QUANTIDADE</label>
            <input type="number" id="txtquantidade" name="txtquantidade" placeholder="DIGITE A QUANTIDADE" value="<?=$quantidade?>" required>
            <br>
            <label>UNIDADE</label>
           
            <select name="txtunidade">

                <option value="kg">KG</option>
                <option value="g">G</option>
                <option value="un">UN</option>
                <option value="lt">LT</option>
            </select>
            <br>
            <label>PREÇO</label>
            <input type="decimal" id="txtpreco" name="txtpreco" placeholder="DIGITE O PREÇO" value="<?=$preco?>" required>
            <br>
            <label>IMAGEM</label>
            <img src="data:image/jpeg;base64, <?= $imagem?>" width="100" height="100" style="border-radius: 5px;">
            <input type="file" name="imagem" id="imagem">
            <br>
            <input type="submit" value="CADASTRAR PRODUTO">

        <!-- SELETOR DE ATIVO E INATIVO -->
         <div class="status">
         <input type="radio" name="status" value="1" <?= $status == '1'?"checked" : ""?>>ATIVO
         <br>
         <input type="radio" name="status" value="0" <?= $status == '0'?"checked" : ""?>>INATIVO
         <br>
         </div> 
        <input type="submit" value="ALTERAR">
</form>
    </div>
</body>
</html>