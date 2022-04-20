<!DOCTYPE html> 
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>REPOSICAO DE LOJA</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery2.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>


</head>
<body>
<div data-role="header" data-theme="b">
<h1>CADASTRO DE GONDOLA</h1>

</div>


<?php
	$sessao = session_id();

	$nome = $_POST['nome'];
	$qtdtotal = $_POST['qtdtotal'];
	$responsavel = $_POST['responsavel'];

	$connect = mysql_connect('localhost','root','');
	$db = mysql_select_db('buscapreco');

		if($nome == "" || $nome == null){
			$erro=1;
			echo"<script language='javascript' type='text/javascript'>alert('O campo nome deve ser preenchido');window.location.href='cadastrogdl.html';</script>";
		}else{
			if($qtdtotal == "" || $qtdtotal == null){
				$erro=1;
				echo"<script language='javascript' type='text/javascript'>alert('O campo quantidade deve ser preenchido');window.location.href='cadastrogdl.html';</script>";
			}else{
				if($responsavel == "" || $responsavel == null){
					$erro=1;
					echo"<script language='javascript' type='text/javascript'>alert('O campo responsavel deve ser preenchido');window.location.href='cadastrogdl.html';</script>";
				}if($erro <= 0){
					$query = "INSERT INTO gondola (nome,qtdtotal,responsavel) VALUES ('$nome','$qtdtotal','$responsavel')";
					$insert = mysql_query($query,$connect);
					echo"<script language='javascript' type='text/javascript'>alert('Gondola cadastrada com sucesso!');window.location.href='cadastrogdl.html'</script>";
				}
			}
		}
?>
</html>