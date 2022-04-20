<?php
session_start();


$sessao = session_id();

include('conexao.php');


?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Selecionar Impressora</title> 
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
<h1 align="center" style="width:100%">Tipo de impressão</h1>

</div>

<a href="impressora_tipo_define.php?tipo=GONDOLA" class="ui-btn ui-corner-all" data-ajax="false">Padrão</a>
<a href="impressora_tipo_define.php?tipo=ETIQUETA" class="ui-btn ui-corner-all" data-ajax="false">Produto</a>
<a href="impressora_tipo_define.php?tipo=ELGIN" class="ui-btn ui-corner-all" data-ajax="false">Produto - ELGIN COHAMA</a>
<a href="impressora_tipo_define.php?tipo=ELGIN" class="ui-btn ui-corner-all" data-ajax="false">Produto - ELGIN SAO FRANCISCO</a>
	<!--<a href="impressora__tipo_define.php?tipo=gondola" class="ui-btn ui-corner-all" data-ajax="false">Promoção</a>';
-->

</body>
</html>