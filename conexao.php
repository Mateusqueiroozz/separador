<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);

$endereco = "localhost";

//cpmy0003.servidorwebfacil.com
$usuario = "root";
$senha = "";
$banco = "reposicao";

$msg[0] = "Conexão com o banco falhou!";
$msg[1] = "Não foi possível selecionar o banco de dados!";

// Fazendo a conexão com o servidor MySQL
$link = mysqli_connect($endereco, $usuario, $senha, $banco);
//mysqli_select_db($link, $banco) or die("não foi possivel conectar ao banco");
$link2 = mysqli_connect($endereco, $usuario, $senha, $banco);
$link3 = mysqli_connect($endereco, $usuario, $senha, $banco);
$link4 = mysqli_connect($endereco, $usuario, $senha, $banco);
$link5 = mysqli_connect($endereco, $usuario, $senha, $banco);
//mysqli_select_db($link,$banco) or die ("não foi possivel conectar ao banco");