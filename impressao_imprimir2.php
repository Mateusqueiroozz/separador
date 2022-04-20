<?php
session_start();

$sessao = session_id();

include('conexao.php');

$impressora = $_SESSION['impressora'];
$gondola = $_POST['gondola'];

//gqwerasd 
$consultaimp = mysql_query("INSERT INTO produtogdl (produtogdl.data_hora, 
produtogdl.codigo, 
produtogdl.sessao, 
produtogdl.produto, 
produtogdl.qtd, 
produtogdl.valor, 
produtogdl.id_situacao) SELECT
impressao.data_hora,
impressao.codigo,
impressao.sessao,
impressao.produto,
impressao.qtd,
impressao.valor,
impressao.id_situacao
FROM
impressao
WHERE
sessao='".$sessao."'
GROUP BY
impressao.codigo");

$consultaimp = mysql_query("UPDATE produtogdl
SET produtogdl.id_gondola ='".$gondola."'
WHERE
produtogdl.sessao='".$sessao."'
");


?>


<!DOCTYPE html> 
<html> 
<head> 
	<title>Impressao</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head> 
<body> 

					</script>
					
					
				</div>
			</div>
			
			
</body>
</html>