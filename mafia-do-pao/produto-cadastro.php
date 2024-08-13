<?php
include('topo.php');
include("conectadb.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nomeproduto = $_POST[ 'txtnome' ];
    $quantidade = $_POST['txtquantidade'];
    $unidade = $_POST['txtunidade'];
    $preco = $_POST['txtpreco'];

    if(isset($_FILES['imagem']) && $_FILES['imagem']['erro'] === UPLOAD_ERR_OK){

    // AJUSTANDO IMAGEM PARA O BANCO
    $imagem_temp = $_FILES['imagem']['tpm_name'];
    $imagem = file_get_contents($imagem_temp);
// CRIPTOGRAFIA IMAGEM EM BASE 64
    $imagem_base64 = base64_encode($imagem);
    };

    // Verificar se o produto existe
    $sql = "SELECT COUNT(pro_id) FROM tb_produtos WHERE pro_nome = '$nomeproduto'";
    
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    if($contagem == 0){
       
        $sql = "INSERT INTO tb_produtos(pro_nome, pro_quantidade, pro_unidade, pro_preco, pro_status, pro_imagem)

        VALUES ('$nomeproduto', $quantidade, '$unidade', $preco, '1', '$imagem_base64')";
         
        $retorno = mysqli_query($link, $sql);

        echo"<script>window.alert('PRODUTO CADASTRADO');</script>";
        echo"<script>window.location.href='produto-lista.php';</script>";
    }
    else{
        echo"<script>window.alert('PRODUTO JÁ EXISTENTE!!');</script>";
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
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
    <title>Cadastro produtos</title>
</head>
<body>
    <div class="container-global">
    <a href="backoffice.php" height="0px" style="margin: 450px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>

        <form action="produto-cadastro.php" class="formulario" method="post">
        <img src="img/logo.png" width="150px" height= "150px"  alt="">
            <label>NOME PRODUTO</label>
            <input type="text" name="txtnome" placeholder="DIGITE O NOME DO PRODUTO" required>
            <br>
            <label>QUANTIDADE</label>
            <input type="number" name="txtquantidade" placeholder="DIGITE A QUANTIDADE" required>
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
            <input type="decimal" name="txtpreco" placeholder="DIGITE O PREÇO" required>
            <br>
            <label>IMAGEM</label>
            <input type="file" name="imagem" id="imagem">
            <br>
            <input type="submit" value="CADASTRAR PRODUTO">
        </form>
    </div>
</body>
</html>