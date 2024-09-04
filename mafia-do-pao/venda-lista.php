<?php
include('conectadb.php');

$sql = "SELECT v.ven_id, v.ven_datavenda, v.ven_totalvenda, v.fk_iv_cod_iv ,v.fk_cli_id, v.fk_usu_id FROM tb_venda v 
JOIN
tb_clientes c ON v.fk_cli_id = c.cli_id
JOIN
tb_usuarios u ON v.fk_usu_id = u.usu_id";

$retorno = mysqli_query($link, $sql);


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