<?php
session_start();

$sessao = session_id();
include('conexao.php');

?>


<!DOCTYPE html> 
<html> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
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
<h1>Selecione uma impressora</h1>

</div>

<?php

$nomearquivo =  "print_server.bat";

if(file_exists($nomearquivo)){
	unlink($nomearquivo);
}


//gera arquivo impressao1.txt
$fp = fopen($nomearquivo, "a");
// Escreve "exemplo de escrita" no bloco1.txt

$texto .= "echo off
COLOR CF
@title Servidor de impressao
echo Aguardando impressoes..
 
:loop
";





$tipo = $_SESSION['tipo']  ;

	$consulta = mysql_query("SELECT * FROM impressora WHERE tipo LIKE '%~$tipo~%' and ativo=1 order by descricao");
	while ($linha = mysql_fetch_array($consulta)){

echo '<a href="impressora_define.php?impressora='.$linha['id'].'" class="ui-btn ui-corner-all" data-ajax="false">'.utf8_encode($linha['descricao']).'</a>';

	}
	
	$consulta2 = mysql_query("SELECT * FROM impressora WHERE ativo=1 order by descricao");
	while ($linha2 = mysql_fetch_array($consulta2)){


	$texto .= "
		
		if exist impressao\imp_".$linha2['id']."_*.txt (
			echo Imprimindo em ".$linha2['descricao']."
			Type impressao\imp_".$linha2['id']."_*.txt > ".$linha2['endereco']."
			del impressao\imp_".$linha2['id']."_*.txt
		) 
		";



	}
	
$texto .= "@TIMEOUT /T 1 /NOBREAK
cls

goto loop

pause >nul";

$escreve = fwrite($fp, $quebra.$texto);
// Fecha o arquivo
fclose($fp);	
?>
</body>
</html>