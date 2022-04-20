<?php
session_start();
$sessao = session_id();
include('conexao.php');

$nomearquivo =  "print_server.bat";

if (file_exists($nomearquivo)) {
	unlink($nomearquivo);
}

//gera arquivo impressao1.txt
$fp = fopen($nomearquivo, "a");

$texto .= "echo off
COLOR CF
@title Servidor de impressao
echo Aguardando impressoes..
 
:loop
";

$consulta2 = mysqli_query($link, "SELECT * FROM impressora WHERE loja = '$loja' order by 1");
while ($linha2 = mysqli_fetch_array($consulta2)) {


	$texto .= "
		
		if exist C:\\xampp\htdocs\\separador\impressao\imp_" . $linha2['id'] . "_*.txt (
			echo Imprimindo em " . $linha2['descricao'] . "
			Type C:\\xampp\htdocs\\separador\impressao\imp_" . $linha2['id'] . "_*.txt > " . $linha2['endereco'] . "
			del C:\\xampp\htdocs\\separador\impressao\imp_" . $linha2['id'] . "_*.txt
		) 
		";
}

$texto .= "@TIMEOUT /T 5 /NOBREAK
cls

goto loop

pause >nul";

$escreve = fwrite($fp, $quebra . $texto);
// Fecha o arquivo
fclose($fp);