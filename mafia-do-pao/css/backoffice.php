<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];

// include ("header.php")

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="./javaScript.js"></script>
    <title>HOME</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>
<style>
    body {
        background-image: url(../mafia-do-pao/img/img-fundo.jpg)
    }
</style>

<body>


        <div class="dropdown">
            <button class="dropbtn">USUARIOS</button>
            <div class="dropdown-content">
                <a href="usuario-cadastro.php">CADASTRAR USUARIOS</a>
                <a href="usuario-lista.php">LISTA DE USUARIOS</a>
               
            </div>
            
            <button class="dropbtn">CLIENTES</button>
            <div class="dropdown-content">
                <a href="usuario-cadastro.php">CADASTRAR CLIENTES</a>
                <a href="usuario-lista.php">LISTA DE CLIENTES</a>
               
            </div>

            <button class="dropbtn">PRODUTOS</button>
            <div class="dropdown-content">
                <a href="usuario-cadastro.php">CADASTRAR PRODUTOS</a>
                <a href="usuario-lista.php">LISTA DE PRODUTOS</a>
               
            </div>

            <button class="dropbtn">VENDAS</button>
            <div class="dropdown-content">
                <a href="usuario-cadastro.php">VENDAS</a>
               
               
            </div>

        </div>


    <div class="topo">
        <img src="img/logo.png" width="80px" height="80px" style="margin-top: -15px;" alt="">
        <?php
        if ($nomeusuario != NULL) {
        ?>
            <li class="perfil"><label>BEM VINDO <?= strtoupper($nomeusuario) ?></label></li>
        <?php
        } else {
            echo ("<script>window.alert('USUARIO NÃO LOGADO');
                window.location.href='login.php';</script>");
        }
        ?>
        <a href="logout.php"><img src="./icons/Exit-02-WF-256.png" width="50px" height="50px"></a>
    </div>

    <div class="menu">
        <a href="usuario-cadastro.php"><span class="tooltiptext">CADASTRAR USUARIO</span><img src="./icons/user-add.png"></a>

        <a href="usuario-lista.php"><span class="tooltiptext">LISTAR USUARIOS</span><img src="./icons/user-find.png"></a>

        <a href="produto-cadastro.php"><span class="tooltiptext">CADASTRAR PRODUTO</span><img src="./icons/parcel.png"></a>

        <a href="produto-lista.php"><span class="tooltiptext"> LISTAR PRODUTO</span><img src="./icons/shopping-cart-02.png"></a>

        <a href="cliente-cadastro.php"><span class="tooltiptext"> CADASTRAR CLIENTE</span><img src="./icons/user-add.png"></a>

        <a href="cliente-lista.php"><span class="tooltiptext"> LISTAR CLIENTE</span><img src="./icons/user-group.png"></a>

        <a href="vendas.php"><span class="tooltiptext"> VENDAS</span><img src="./icons/shopping-cart-04.png"></a>
    </div>
    </div>


</body>

</html>