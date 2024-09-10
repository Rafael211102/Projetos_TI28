<?php
include('conectadb.php');


#PESQUISA A DATA MIN E MAX PARA OS FILTROS

$selectdatamin = "SELECT MIN(ven_datavenda) FROM tb_venda";
$selectdatamax = "SELECT MAX(ven_datavenda) FROM tb_venda";

$resultado_data_min = mysqli_query($link, $selectdatamin);
$resultado_data_max = mysqli_query($link, $selectdatamax);

$data_min = mysqli_fetch_array($resultado_data_min);
$data_max = mysqli_fetch_array($resultado_data_max);

//CONFIGURANDO A DATA PARA QUE O HTML MOSTRE CERTO
$data_min_string = date("Y-m-d", strtotime($data_min[0]));
$data_max_string = date("Y-m-d", strtotime($data_max[0]));

#PESQUISA OS CLIENTES PARA O FILTRO
$sqlcli = "SELECT cli_id, cli_nome FROM tb_clientes";
$retornocli = mysqli_query($link, $sqlcli);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idcliente = $_POST['idcliente'];
    $datainicial = $_POST['datainicial'];
    $datafinal = $_POST['datafinal'];

    if ($datainicial < 0) {
        $datainicial = $data_min_string;
    }
    if ($datafinal < 0) {
        $datafinal = $data_max_string;
    }


    $sql = "SELECT v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv ,v.fk_cli_id, v.fk_usu_id, c.cli_nome, u.usu_login FROM tb_venda v 
JOIN
tb_clientes c ON v.fk_cli_id = c.cli_id
JOIN
tb_usuarios u ON v.fk_usu_id = u.usu_id
WHERE
v.ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59'";
    //$retorno = mysqli_query($link, $sql. "ORDER BY v.ven_id");

    $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda
    WHERE
    ven_datavenda BETWEEN '$datainicial 0:0:0' AND '$datafinal 23:59:59'";
    // $retornovalortotal = mysqli_query($link, $valortotal);

    if ($idcliente == 'todos') {
        $retorno = mysqli_query($link, $sql . " ORDER BY ven_id");
        $retornovalortotal = mysqli_query($link, $valortotal . " ORDER BY ven_id");
    } else {
        $sql .= "AND c.cli_id = " . $idcliente . " ORDER BY ven_id";
        $retorno = mysqli_query($link, $sql);

        $valortotal .= "AND fk_cli_id = " . $idcliente . " ORDER BY ven_id";
        $retornovalortotal = mysqli_query($link, $valortotal);
    }
} else {
    $sql = "SELECT v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv ,v.fk_cli_id, v.fk_usu_id, c.cli_nome, u.usu_login FROM tb_venda v 
JOIN
tb_clientes c ON v.fk_cli_id = c.cli_id
JOIN
tb_usuarios u ON v.fk_usu_id = u.usu_id";
    $retorno = mysqli_query($link, $sql . " ORDER BY v.ven_id");
    $valortotal = "SELECT SUM(ven_totalvenda) FROM tb_venda";
    $retornovalortotal = mysqli_query($link, $valortotal);
}

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <script src="./javaScript.js"></script>
    <title>VENDA-LISTA</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>

<header>
    <?php
    session_start();
    $nomeusuario = $_SESSION['nomeusuario'];
    ?>

    <div class="topo">
        <a href="./backoffice.php"><img src="img/logo.png" width="80px" height="80px" style="margin-top: -15px;" alt=""></a>
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
        <span style="position: relative; float: left; left: 430px; margin-top: -5px;"><a href="backoffice.php"><img src="./icons/Navigation-left-01-256.png" width="70px" height="60px" alt="Voltar"></a></span>
        <a href="logout.php"><img src="./icons/Exit-02-WF-256.png" width="50px" height="50px"></a>
    </div>

</header>

<body>
    <div class="container-global" id="venda-lista">
        <form action="venda-lista.php" method="post" class="formulario">
            <label>VALOR TOTAL BRUTO</label>
            <!-- php para retornar a soma do valor total -->
            <?php
            while ($tblvalortotal = mysqli_fetch_array($retornovalortotal)) {
                echo "R$ " . $tblvalortotal[0];
            } ?>
            <br><br>
            <label>FILTROS</label>
            <br>
            <label for="data">SELECIONA A DATA INICIAL:</label>
            <input name="datainicial" id="datainicial"
                min="<?= $data_min_string ?>" max="<?= $data_max_string ?>" type="date">

            <label for="data">SELECIOE A DATA FINAL:</label>
            <input id="datafinal" name="datafinal"
                min="<?= $data_min_string ?>" max="<? $data_max_string ?>" type="date">

            <!-- Filtro para pesquisa de cliente -->
            <label>SELECINE O CLIENTE:</label>
            <select name="idcliente">
                <option value="todos">TODOS</option>
                <?php while ($tblcli = mysqli_fetch_array($retornocli)) {
                ?>
                    <option value="<?= $tblcli[0] ?>"><?= strtoupper($tblcli[1]) ?></option>
                <?php

                } ?>
            </select>
            <br>
            <input type="submit" value="PESQUISAR">

        </form>
    </div>




    <div class="container-listausuarios">


        <!-- Listar tabela de produtos -->
        <table class="lista">
            <tr>
                <th>CÓDIGO</th>
                <th>DATA/HORA</th>
                <th>VALOR</th>
                <th>CLIENTE</th>
                <th>VENDEDOR</th>
                <th>VISUALIZAR</th>
            </tr>


            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS PRODUTOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl[0] ?></td> <!-- COLETA O ID DA VENDA -->
                    <td><?= $tbl[1] ?></td> <!-- COLETA A DATA E HORA DA VENDA -->
                    <td><?= $tbl[2] ?></td> <!-- COLETA O VALOR DA VENDA -->
                    <td><?= $tbl[4] ?></td> <!-- COLETA O CLIENTE -->
                    <td><?= $tbl[5] ?></td> <!-- COLETA O VENDEDOR -->

                    <td>
                        <input type="button" value="VISUALIZAR">

                    </td>
                </tr>

            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>