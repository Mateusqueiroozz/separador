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
$impressora = $_SESSION['impressora'];
$codigo = $_GET['codigo'];
$produto = $_GET['produto'];
$valor = $_GET['valor'];
$quantidade = $_GET['qtd'];
$d = $_GET['d'];
//insere no bano e regera arquivo
$tipo  = $_SESSION['tipo'];




mysql_query("INSERT INTO impressao (sessao, id_impressora,data_hora, codigo, produto, valor, id_situacao,qtd,tipo) VALUES ('".$sessao ."', '".$impressora."',NOW(), '".$codigo ."', '".$produto."', '".$valor."', '1','".$quantidade."','".$tipo."')");
//echo $codigo. $descricao.$valor;

if($d==1){

	echo '<script>location.href = "index2.php";</script>';
}else{
	echo '<script>location.href = "index2.php?codigo='.$codigo.'&n=1";</script>';
}


?>
</body>
</html>