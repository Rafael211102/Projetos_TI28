<?php
//Usando metodo get para coletar notas
//PARA COLETAR DADOS USANDO METODO GET [seuscript.php?suavariavel=seuvalor$outravariavel=outrovalor]
$nota1 = $_GET ['nota1'];
$nota2 = $_GET ['nota2'];
$nota3 = $_GET ['nota3'];
$nome = $_GET ['nome'];

echo ("Nome do Aluno: " . $nome);
echo("<br>");
echo("Notas: ");
echo("<br>");
echo($nota1 . ("<br>") . $nota2 . ("<br>") . $nota3);

echo("<br>");
echo("<br>");
$media = (($nota1 + $nota2 + $nota3) / 3);
echo("Média: " . $media);

echo("<br>");

if($media >= 7 ){
echo("Você está aprovado(a)!!");
}
else if($media >=6){
    echo("Você está de recuperação(a)!");
}
else{
    echo("Você está reprovado(a)!");
}
echo("<br>");
echo("<br>");
echo("<br>");
echo("-------------------------------------------");
echo("<br>");
echo("<br>");
echo("<br>");
$num1 = 342;
$num2 = 12;

echo("Calculo de 12% de 342: ");
echo("<br>");
$calc = ((342 * 12) /100);

echo("Resultado: " . $calc);
?>