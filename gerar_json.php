<?php
include('conexao.php');
$sql = "select * from t_repos1";
$resultado = mysqli_query($link, $sql);
// atribui o resultado a um array

//$meu_array[] = ["data" => ['']];

while ($row = mysqli_fetch_assoc($resultado)) {
    $meu_array['data'][] = $row;
}




// Retorna a string contendo a representação JSON
$json = json_encode($meu_array);
// abre o arquivo em modo escrita
$file = fopen('./data.json', 'w');
// escreve o json no arquivo
fwrite($file, $json);