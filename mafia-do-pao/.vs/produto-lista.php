<?php
include('conectadb.php');
include('topo.php');

// A pagina carregou... o que ela vai fazer?

// A pesquisa no banco todos os produtos do banco
$sql = "SELECT * FROM tb_produtos WHERE pro_status IN ('0', '1')" ;
$retorno = mysqli_query($link, $sql);
$status = '';

// Função após click do radio ativo e inativo
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $status = $_POST['status'];

    if($status == '1'){
        $sql = "SELECT * FROM tb_produtos WHERE pro_status = '1'";
        $retorno = mysqli_query($link, $sql);
    }
    else{
        $sql = "SELECT * FROM tb_produtos WHERE pro_status = '0'";
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
    <title>LISTA DE PRODUTOS</title>
    <link rel="shortcut icon" href="./icons/logo-icon.ico" type="image/x-icon">
</head>


<body>
    
<div class="container-listausuarios">
        <form action="produto-lista.php" method="post">
            <input type="radio" name="status" value="1" required onclick="submit()" <?=$status=='1' ? "checked": ""?>>ATIVOS
            <br>
            <input type="radio" name="status" value="0" required onclick="submit()" <?=$status=='0' ? "checked": ""?>>INATIVOS
        </form>
    
        <!-- Listar tabela de produtos -->
        <table class="lista">
            <tr>
                <th>CÓDIGO</th>
                <th>NOME DO PRODUTO</th>
                <th>QUANTIDADE</th>
                <th>UNIDADE</th>
                <th>PREÇO</th>
                <th>STATUS</th>
                <th>IMAGEM</th>
                <th>ALTERAR</th>
            </tr>
            
            
            <!-- BUSCAR NO BANCO OS DADOS DE TODOS OS PRODUTOS -->
            <?php
            while ($tbl = mysqli_fetch_array($retorno)) {
            ?>
                <tr>
                    <td><?= $tbl['pro_id'] ?></td> <!-- COLETA O ID DO PRODUTO -->
                    <td><?= $tbl['pro_nome'] ?></td> <!-- COLETA O NOME DO PRODUTO -->
                    <td><?= $tbl['pro_quantidade'] ?></td> <!-- COLETA A QUANTIDADE DO PRODUTO -->
                    <td><?= $tbl['pro_unidade'] ?></td> <!-- COLETA A UNIDADE DO PRODUTO -->
                    <td><?= $tbl['pro_preco'] ?></td> <!-- COLETA O PREÇO DO PRODUTO -->
                    <td><?= $tbl['pro_status'] ?></td> <!-- COLETA O STATUS -->
                    <td><img src='data:image/jpeg;base64, <?= $tbl['pro_imagem'] ?> 'width="100" height="80"></td> <!-- COLETA A IMAGEM -->
              
                    <td><a href="produto-altera.php?id=<?= $tbl['pro_id'] ?>">
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
