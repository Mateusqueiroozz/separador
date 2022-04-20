<?php
session_start();

$sessao = session_id();

include('conexao.php');


$impressora = $_GET['impressora'];
$_SESSION['impressora'] = $impressora;

$tipo = $_GET['tipo'];
$_SESSION['tipo'] = $tipo;


if($tipo=="GONDOLA"){
	mysqli_query("UPDATE impressao SET tipo='GONDOLA' WHERE sessao='".$sessao."' and id_situacao=1");
	
}

if($tipo=="ETIQUETA"){
	mysqli_query("UPDATE impressao SET tipo='ETIQUETA' WHERE sessao='".$sessao."' and id_situacao=1");
	
}

if($tipo=="ELGIN"){
	mysqli_query("UPDATE impressao SET tipo='ELGIN' WHERE sessao='".$sessao."' and id_situacao=1");
	
}




Header("Location: index.php");


?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Selecionar Impressora</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head> 
<body> 

</body>
</html>