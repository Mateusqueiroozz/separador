<?php
$endereco = "localhost";
$usuario = "root";
$senha = "";
$banco = "reposicao";

$link = mysqli_connect($endereco, $usuario, $senha, $banco);
$sql = "UPDATE atendimentos SET situacao = 'B', fim_separacao = NOW(), itens_atendidos = '$itens_atendidos' WHERE id = '$id_atendimento'";

$resultado = mysqli_query($link, $sql);

if (mysqli_errno($link)) {
    echo "ERRO AO GRAVAR DADOS DA FINALIZAÇÃO DA SEPARAÇÃO. ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA";
} else {
    echo "SEPARAÇÃO FINALIZADA COM SUCESSO";
}