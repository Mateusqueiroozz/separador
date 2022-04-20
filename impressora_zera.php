<?php
session_start();
session_destroy();

$sessao = session_id();

include('conexao.php');



$_SESSION['impressora'] = '';





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