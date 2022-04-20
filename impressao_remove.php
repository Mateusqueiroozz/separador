<?php
session_start();
include('conexao.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Limpar Impressão</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
</head>

<body>
    <?php
	$sessao = session_id();	
	$codigo = $_GET['id'];

	mysqli_query($link, "DELETE FROM impressao WHERE codigo='" . $codigo . "' and sessao = '" . $sessao . "'");
	
	echo '<script>location.href = "index.php";</script>';
	?>
</body>

</html>