<?php
session_start();


$sessao = session_id();

include('conexao.php');


?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Limpar Impressão</title> 
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
$codigo = $_POST['codigo'];
$produto = $_POST['produto'];
$valor = $_POST['valor'];

//insere no bano e regera arquivo


mysqli_query($link,"UPDATE impressao SET id_situacao='0' WHERE sessao='".$sessao."'");

//mysql_query("DELETE FROM `impressao` WHERE sessao='".$sessao."'");
echo $codigo. $descricao.$valor;


echo '<script>location.href = "index.php";</script>';
?>
</body>
</html>