<?php
session_start();

$sessao = session_id();

include('conexao.php');

$impressora = $_GET['impressora'];
$_SESSION['impressora'] = $impressora;
$_SESSION['auto'] = 0;

mysqli_query($link,"UPDATE impressao SET id_impressora= '$impressora' WHERE sessao= '".$sessao."' and id_situacao= 1");

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