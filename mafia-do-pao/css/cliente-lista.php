<?php 
include('conectadb.php');


// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status
        FROM tb_clientes WHERE cli_status IN ('0', '1')";
$retorno = mysqli_query($link, $sql);
$status = '';

// Enviando para o servidor o seletor radio em 0 ou 1
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status 
                FROM tb_clientes WHERE cli_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status 
                FROM tb_clientes WHERE cli_status = '0'";
        $retorno = mysqli_query($link, $sql);
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
    <title>LISTA DE CLIENTES</title>
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

<body>
    
    <div class="container-listausuarios">
        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?=$status=='1' ? "checked": ""?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?=$status=='0' ? "checked": ""?>>INATIVOS
        </form>
    
        <!-- Listar tabela de clientes -->
        <table class="lista">
            <tr>
                <th>CÓDIGO</th>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>
            
            
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl['cli_id'] ?></td> <!-- COLETA O CÓDIGO DO USUÁRIO -->
                    <td><?= $tbl['cli_cpf'] ?></td> <!-- COLETA O CPF DO USUÁRIO -->
                    <td><?= $tbl['cli_nome'] ?></td> <!-- COLETA O NOME DO USUÁRIO -->
                    <td><?= $tbl['cli_email'] ?></td> <!-- COLETA O EMAIL DO USUÁRIO -->
                    <td><?= $tbl['cli_cel'] ?></td> <!-- COLETA O TELEFONE DO USUÁRIO -->
                    <td><?= $tbl['cli_status'] ?></td> <!-- COLETA O STATUS DO USUÁRIO -->
              
                    <td><a href="cliente-altera.php?id=<?= $tbl['cli_id'] ?>">
                        <input type="button" value="ALTERAR">
                        </a>
                    </td>
                </tr>
                
            <?php
            }
            ?>
        </table>
    </div>

</body>

</html>
