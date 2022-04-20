<?php
session_start();


$sessao = session_id();

include('conexao.php');


?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Adiconar impressão</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head> 
<body> 
<!--<div data-role="header" data-theme="b">
<h1>Adiconado</h1>

</div>
-->
<?php

$sessao = session_id();
$avulsa =  $_SESSION['avulsa'];
$impressora = $_SESSION['impressora'];
$codigo = $_GET['codigo'];
$produto = $_GET['produto'];
$complemento = $_GET['complemento'];
$ncm = $_GET['ncm'];
$codmdlog = $_GET['codmdlog'];
$valor = $_GET['valor'];
$quantidade = $_GET['qtd'];
$estloja10 = $_GET['estloja10'];
$estloja20 = $_GET['estloja20'];
$estloja30 = $_GET['estloja30'];
$d = $_GET['d'];
//insere no bano e regera arquivo
$tipo  = $_SESSION['tipo'];




mysqli_query($link, "INSERT INTO impressao (sessao, id_impressora,data_hora, codigo, produto, complemento, valor, id_situacao,qtd,tipo, ncm, codmdlog, estloja10, estloja20, estloja30) VALUES ('".$sessao ."', '".$impressora."',NOW(), '".$codigo ."', '".$produto."', '".$complemento."', '".$valor."', '1','".$quantidade."','".$tipo."', '".$ncm."', '".$codmdlog."', '".$estloja10."', '".$estloja20."', '".$estloja30."')");
//echo $codigo. $descricao.$valor;

if($avulsa ==1){	
	echo '<script>location.href = "impressao_imprimir.php";</script>';
}

if($d==1){

	echo '<script>location.href = "index.php";</script>';
}else{
	echo '<script>location.href = "index.php?codigo='.$codigo.'&n=1";</script>';
}


?>
</body>
</html>