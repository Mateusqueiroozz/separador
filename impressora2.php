<?php
session_start();


$sessao = session_id();

include('conexao.php');


?>
<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>REPOSICAO DE LOJA</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    
    <style>
	.ui-header .ui-title, .ui-footer .ui-title {
    
    margin: 0 !important;
}
	</style>
</head> 
<body> 
<div data-role="header" data-theme="b">
<h1>REPOSICAO DE LOJA</h1>

</div>
<form method="POST" action="cadastrogdl.html">
<div  class="cadastrogdl">
<input type="submit" value="CADASTRAR GONDOLA" data-icon="" data-theme="a">
</form>
</div>

<form method="POST" action="selecaogdl.php">
<input type="submit" value="ALIMENTAR GONDOLA" data-icon="" data-theme="a">
</form>
<div  class="monitorargdl">
<input type="submit" value="MONITORAR GONDOLA" data-icon="" data-theme="a">

</div>
<?php


?>
</body>
</html>