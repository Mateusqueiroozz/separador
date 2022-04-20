<?php
$loja = $_SESSION['loja'];
$endereco = "localhost";
$usuario = "root";
$senha = "";
$banco = "reposicao";

$link = mysqli_connect($endereco, $usuario, $senha, $banco);
$sql = "SELECT * FROM impressora WHERE loja = '$loja'";
