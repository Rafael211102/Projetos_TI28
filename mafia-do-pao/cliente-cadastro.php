<?php
include("conectadb.php");
include('topo.php');

if($_SERVER['REQUEST_METHOD']=='POST'){
    $cpf = $_POST['txtcpf'];
    $nome = $_POST['txtnome'];
    $email = $_POST['txtemail'];
    $telefone = $_POST['txttel'];

    //Valida se o cliente existe
    $sql = "SELECT COUNT(cli_id)FROM tb_clientes WHERE cli_nome = '$nome' OR cli_email = '$email'";

    //RETORNO DO BANCO
    $retorno = mysqli_query($link, $sql);
    $contagem = mysqli_fetch_array($retorno) [0];

    //Verificar se cliente existe
    if($contagem == 0){
        $sql = "INSERT INTO tb_clientes(cli_cpf, cli_nome, cli_email, cli_cel, cli_status) VALUES('$cpf', '$nome', '$email', '$telefone', '1')";
        mysqli_query($link, $sql);
        echo"<script>window.alert('CLIENTE CADASTRADO COM SUCESSO');</script>";
        echo"<script>window.location.href='cliente-lista.php';</script>";
    }
    else if($contagem >=1){
        echo"<script>window.alert('CLIENTE JÁ EXISTE!');<script>";
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
       <a href="backoffice.php" height="0px" style="margin: 450px 0px 300px 0px;" ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
        <form class="formulario" action="cliente-cadastro.php" method="post">
       
        <label>CPF</label>
        <br>
        <input type="text" id="cpf" name="txtcpf" placeholder="000.000.000-00" maxlength="14" oninput="formatarCPF()">
        <br>
        <label>NOME</label>
        <br>
        <input type="text" name="txtnome" placeholder="Digite o nome" required>
        <br>
        <label>EMAIL</label>
        <br>
        <input type="email" name="txtemail" placeholder="Digite o email" required>
        <br>
        <label>TELEFONE</label>
        <br>
        <input type="text" id="telefone" name="txttel" placeholder="(XX) X XXXX-XXXX" maxlength="16" oninput="formatarTelefone()">
        <br>
        
        <input type="submit" value="CRIAR">
</form>
    </div>
</body>

<script>
        
        
    </script>
</html>