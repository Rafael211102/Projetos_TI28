
<?php 
include('conectadb.php');
include('topo.php');

// CONSULTA USUARIOS CADASTRADOS
$sql = "SELECT usu_login, usu_email, usu_status, usu_id
        FROM tb_usuarios WHERE usu_status IN ('0', '1')";
        $retono = mysqli_query($link, $sql);
        $status = '';

        // Enviando para o servidor o seletor radio em 0 ou 1
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT usu_login, usu_email, usu_status, usu_id
        FROM tb_usuarios WHERE usu_status = '1'";
        $retono = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT usu_login, usu_email, usu_status, usu_id
        FROM tb_usuarios WHERE usu_status = '0'";
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
    <title>LISTA DE USUARIOS</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>

<body>
    <div class="container-listausuarios">
    <form action="usuario-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?=$status=='1' ? "checked": ""?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?=$status=='0' ? "checked": ""?>>INATIVOS
        </form>
        <!-- Listar tabela de usuarios -->
        <table  class="lista">
            <tr>
                <th>LOGIN</th>
                <th>EMAIL</th>
                <th>STATUS</th>
                <th>ALTERAR</th>
            </tr>

            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS USUARIOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retono)) {
            ?>
                <tr>
                    <td><?= $tbl[0] ?></td> <!-- COLETA O NOME  DO USUARIO-->
                    <td><?= $tbl[1] ?></td> <!-- COLETA O EMAIL  DO USUARIO-->
                    <td><?= $tbl[2] ?></td> <!-- COLETA O STATUS  DO USUARIO-->
                    <td><a href="usuario-altera.php?id=<?= $tbl[3] ?>">
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