<?php 
include('conectadb.php');

// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT cli_cpf, cli_nome, cli_email, cli_cel, cli_status, cli_id
        FROM tb_clientes WHERE cli_status = '1'";
        $retono = mysqli_query($link, $sql);
        $status = '1';

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <title>LISTA DE CLIENTES</title>
</head>

<body>
    <div class="container-listausuarios">
        <form>

        </form>
        <!-- Listar tabela de usuarios -->
        <table  class="lista">
            <tr>
                <th>CPF</th>
                <th>NOME</th>
                <th>EMAIL</th>
                <th>TELEFONE</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>
            <a href="backoffice.php" height="0px"  ><img src="./icons/Navigation-left-01-256.png" width="80px" height="80px"  alt="Voltar" ></a>
            
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retono)) {
            ?>
                <tr>
                    <td><?= $tbl[0] ?></td> <!-- COLETA O CPF  DO USUARIO-->
                    <td><?= $tbl[1] ?></td> <!-- COLETA O NOME  DO USUARIO-->
                    <td><?= $tbl[2] ?></td> <!-- COLETA O EMAIL  DO USUARIO-->
                    <td><?= $tbl[3] ?></td> <!-- COLETA O TELEFONE  DO USUARIO-->
                    <td><?= $tbl[4] ?></td> <!-- COLETA O STATUS  DO USUARIO-->
                    <td><a href="cliente-altera.php?id=<?= $tbl[5] ?>">
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