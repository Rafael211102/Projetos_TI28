<?php
include('conectadb.php');
include('topo.php');

// Preenchimento dos campos
$id = $_GET['id'];
$sql = "SELECT * FROM tb_produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nomeproduto = $tbl[1];
    $quantidade = $tbl[2];
    $unidade = $tbl[3];
    $preco = $tbl[4];
    $status = $tbl[5];
    $imagem_atual = $tbl[6];
}

//Apertar botão alterar
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nomeproduto = $_POST['txtnome'];
    $quantidade = $_POST['txtquantidade'];
    $unidade = $_POST['txtunidade'];
    $preco = $_POST['txtpreco'];
    $status = $_POST['status'];
    $imagem = $_POST['imagem'];


    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        // AJUSTANDO IMAGEM PARA O BANCO
        $imagem_temp = $_FILES['imagem']['tmp_name'];
        $imagem = file_get_contents($imagem_temp);
        // CRIPTOGRAFIA IMAGEM EM BASE 64
        $imagem_base64 = base64_encode($imagem);
    };


    //   Verificar se a imagem que está chegando é igual que será gravada
    if ($imagem_atual == $imagem_base64) {
        $sql = "UPDATE tb_produtos SET pro_nome = '$nomeproduto', pro_quantidade = $quantidade, pro_unidade = '$unidade', pro_preco = $preco, pro_status = '$status' WHERE pro_id = $id";
        mysqli_query($link, $sql);

        echo "<script>window.alert('PRODUTO ALTERADO');</script>";
        echo "<script>window.location.href='produto-lista.php';</script>";
    } else {
        $sql = "UPDATE tb_produtos SET pro_nome = '$nomeproduto', pro_quantidade = $quantidade, pro_unidade = '$unidade', pro_preco = $preco, pro_status = '$status', pro_imagem = '$imagem_base64' WHERE pro_id = $id";
        mysqli_query($link, $sql);

        echo "<script>window.alert('PRODUTO ALTERADO');</script>";
        echo "<script>window.location.href='produto-lista.php';</script>";
    }
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

<body>

    <div class="container-global">

        <form class="formulario" action="produto-altera.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id?>">
            <label>NOME PRODUTO</label>
            <input type="text" id="txtnome" name="txtnome" placeholder="DIGITE O NOME DO PRODUTO" value="<?= $nomeproduto ?>" required>
            <br>
            <label>QUANTIDADE</label>
            <input type="number" id="txtquantidade" name="txtquantidade" placeholder="DIGITE A QUANTIDADE" value="<?= $quantidade ?>" required>
            <br>
            <label>UNIDADE</label>

            <select name="txtunidade">  
                <option value=""><?= strtoupper($unidade)?></option>
                <option value="kg">KG</option>
                <option value="g">G</option>
                <option value="un">UN</option>
                <option value="lt">LT</option>
            </select>
            <br>
            <label>PREÇO</label>
            <input type="decimal" id="txtpreco" name="txtpreco" placeholder="DIGITE O PREÇO" value="<?= $preco ?>" required>
            <br>
            <label>IMAGEM</label>
            <img src="data:image/jpeg;base64, <?= $imagem_atual ?>" width="100" height="100" style="border-radius: 5px;">
            <input type="file" name="imagem" id="imagem">
            <br>
          

            <!-- SELETOR DE ATIVO E INATIVO -->
            <div class="status">
                <input type="radio" name="status" value="1" <?= $status == '1' ? "checked" : "" ?>>ATIVO
                <br>
                <input type="radio" name="status" value="0" <?= $status == '0' ? "checked" : "" ?>>INATIVO
                <br>
            </div>
            <input type="submit" value="ALTERAR">
        </form>
    </div>
</body>

</html>