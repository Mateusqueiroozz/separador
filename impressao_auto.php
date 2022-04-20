<?php
session_start();


$sessao = session_id();

include('conexao.php');


if($_SESSION['auto']==0){
$_SESSION['auto']= "1";



}else{
	$_SESSION['auto']= "0" ;
	
}


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




echo '<script>location.href = "index.php";</script>';
?>
</body>
</html>