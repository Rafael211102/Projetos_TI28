<?php 
include('conectadb.php');
include('topo.php');

// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status
        FROM tb_clientes WHERE cli_status IN ('0', '1')";
$retono = mysqli_query($link, $sql);
$status = '';

// Enviando para o servidor o seletor radio em 0 ou 1
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status 
                FROM tb_clientes WHERE cli_status = '1'";
        $retono = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT cli_id, cli_cpf, cli_nome, cli_email, cli_cel, cli_status 
                FROM tb_clientes WHERE cli_status = '0'";
        $retono = mysqli_query($link, $sql);
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

<body>
    
    <div class="container-listaclientes">
        <form action="cliente-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?=$status=='1' ? "checked": ""?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?=$status=='0' ? "checked": ""?>>INATIVOS
        </form>
        <!-- Listar tabela de usuarios -->
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
            while ($tbl = mysqli_fetch_array($retono)) {
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
    <a href="backoffice.php" height="0px"  ><img src="./icons/Navigation-left-01-256.png" width="50px" height="50px"  alt="Voltar" style="align-items: center;"></a>
</body>

</html>
