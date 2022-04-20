<?php
$loja = $_SESSION['loja'];
$endereco = "localhost";
$usuario = "root";
$senha = "";
$banco = "reposicao";

$link = mysqli_connect($endereco, $usuario, $senha, $banco);
$sql = "SELECT at.id as id, CONCAT( at.cod_documento, ' - ', aten.codigo, ' - ', aten.nome, ' P/ ', at.tipo_atendimento) as linha from atendimentos at
left join atendentes aten on (at.id_atendente = aten.id)
WHERE at.situacao = 'A' and at.loja = '$loja'";