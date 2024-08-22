<?php 
include("conectadb.php");
include('topo.php');

if($_SERVER['REQUEST_METHOD']== 'POST'){
    $login = $_POST['txtlogin'];
    $senha =$_POST['txtsenha'];
    $email =$_POST['txtemail'];

    // VALIDA SE O USUARIO CADASTRAR EXISTE
    $sql ="SELECT COUNT(usu_id)FROM tb_usuarios WHERE usu_login = '$login' OR usu_email = '$email'";


// RETORNO DO BANCO
$retorno = mysqli_query($link, $sql);
$contagem = mysqli_fetch_array($retorno) [0];

// VERIFICA SE USUARIO EXISTE
if($contagem == 0){
    $sql = "INSERT INTO tb_usuarios(usu_login, usu_senha, usu_email, usu_status) VALUES('$login', '$senha', '$email', '1')";
    mysqli_query($link, $sql);
    echo"<script>window.alert('USARIO CADASTRADO COM SUCESSO');</script>";
    echo"<script>window.location.href='login.php';</script>";
}
else if($contagem >=1){
    echo"<script>window.alert('USUARIO JÁ EXISTE!');</script>";
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
    <title>CADASTRO DE USUARIO</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
    
</head>
<body >
    
    <div class="container-global">
       <a href="backoffice.php" height="0px" style="margin: 400px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
        <form class="formulario" action="usuario-cadastro.php" method="post">
       
        <label>LOGIN</label>
        <br>
        <input type="text" name="txtlogin" placeholder="Digite seu login" required>
        <br>
        <label>SENHA</label>
        <br>
        <input type="password" name="txtsenha" placeholder="Digite a sua senha" required>
        <br>
        <label>EMAIL</label>
        <br>
        <input type="email" name="txtemail" placeholder="Digite o seu email" required>
        <br>
        <br>
        <input type="submit" value="CRIAR">
</form>
    </div>
</body>
</html>