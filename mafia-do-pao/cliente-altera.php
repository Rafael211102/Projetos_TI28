<?php
include('conectadb.php');
include('topo.php');

//Coleta o valor id lá da url
$id = $_GET['id'];
$sql = "SELECT * FROM tb_clientes WHERE cli_id = '$id'";
$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $cpf = $tbl[1];
        $nome = $tbl[2];
        $email = $tbl[3];
        $telefone = $tbl[4];
        $status = $tbl[5];
    }

    //Fazer update
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $email = $_POST['txtemail'];
        $telefone = $_POST['txttel'];
        $status = $_POST['status'];

        $sql = "UPDATE tb_clientes SET cli_email = '$email', cli_cel = '$telefone', cli_status = '$status' WHERE cli_id = '$id'";

        mysqli_query($link, $sql);

    echo"<script>window.alert('CLIENTE ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='cliente-lista.php';</script>";
    exit();
    }
    ?>

    <!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="./javaScript.js"></script>
    <title>ALTERAÇÃO DE CLIENTE</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>
<body >
    
    <div class="container-global">
       <a href="backoffice.php" height="0px" style="margin: 400px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
        <form class="formulario" action="cliente-altera.php" method="post">
       
        <input type="hidden" name="id" value="<?= $id?>">
        <label>CPF</label>
        <br>
        <input type="text" id="cpf" name="txtcpf" value="<?=$cpf?>" disabled>
        <label>CLIENTE</label>
        <br>
        <input type="text" name="txtnome"  value="<?=$nome?>" required disabled>
        <br>
        <label>NOVO EMAIL</label>
        <br>
        <input type="email" name="txtemail" placeholder="Digite o novo email" value="<?=$email?>" required>
        <br>
        <label>NOVO TELEFONE</label>
        <br>
        <input type="text" id="telefone" name="txttel" placeholder="(XX) X XXXX-XXXX" maxlength="16" oninput="formatarTelefone()" value="<?=$telefone?>" require>
        <br>
     

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