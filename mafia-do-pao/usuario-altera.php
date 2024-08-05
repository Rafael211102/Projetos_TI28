<?php
include('conectadb.php');

// COLETA O VALOR ID LÁ DA URL
$id = $_GET['id'];
$sql = "SELECT * FROM tb_usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($retorno)){
        $login = $tbl[1];
        $email = $tbl[2];
        $senha = $tbl[3];
        $status = $tbl[4];
    }

    // FAZER UPDATE
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = $_POST['id'];
        $senha = $_POST['txtsenha'];
        $email = $_POST['txtemail'];
        $status = $_POST['status'];

        $sql = "UPDATE tb_usuarios SET usu_senha = '$senha', usu_email = '$email', usu_status = '$status' WHERE usu_id = '$id'";
    

    mysqli_query($link, $sql);

    echo"<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
    echo"<script>window.location.href='usuario-lista.php';</script>";
    exit();
    }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>ALTERAÇÃO DE USUARIO</title>
</head>
<body >
    
    <div class="container-global">
       <a href="backoffice.php" height="0px" style="margin: 400px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
        <form class="formulario" action="usuario-altera.php" method="post">
       
        <input type="hidden" name="id" value="<?= $id?>">

        <label>NOVO LOGIN</label>
        <br>
        <input type="text" name="txtlogin" placeholder="Digite seu novo login" value="<?=$login?>" required disabled>
        <br>
        <label>NOVA SENHA</label>
        <br>
        <input type="password" name="txtsenha" placeholder="Digite a sua nova senha" value="<?=$senha?>" required>
        <br>
        <label>NOVO EMAIL</label>
        <br>
        <input type="email" name="txtemail" placeholder="Digite o seu novo email" value="<?=$email?>" required>
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