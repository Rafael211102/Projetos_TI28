<?php 
include("conectadb.php");

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

<header>
<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];
?>

        <div class="topo">
        <a href="./backoffice.php"><img src="img/logo.png" width="80px" height= "80px" style="margin-top: -15px;"  alt=""></a>
            <?php
            if ($nomeusuario !=NULL){
            ?>
            <li class="perfil"><label>BEM VINDO <?= strtoupper($nomeusuario)?></label></li>
            <?php
            }

            else{
                echo("<script>window.alert('USUARIO NÃO LOGADO');
                window.location.href='login.php';</script>");
            }
            ?>
                    <span style="position: relative; float: left; left: 430px; margin-top: -5px;"><a href="backoffice.php"><img src="./icons/Navigation-left-01-256.png" width="70px" height="60px"  alt="Voltar" ></a></span>
            <a href="logout.php"><img src="./icons/Exit-02-WF-256.png" width="50px" height="50px"></a>
        </div>
</header>

<body >
    
    <div class="container-global">
       
        <form class="formulario" action="usuario-cadastro.php" method="post">
        <img src="img/logo.png" width="150px" height= "150px"  alt="Logo Mafia do Pão">

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