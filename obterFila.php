<?php

    include('conexao.php');
    
    // PRUEBAS
    //$usuario = "cheko";
    $sessao = $_GET['sessao'];    
    
    $sql = "SELECT
impressao.data_hora,
impressao.tipo,
impressao.codigo,
impressao.produto,
impressao.complemento,
impressao.ncm,
impressao.codmdlog,
impressao.valor,
impressao.id_situacao,
Sum(impressao.qtd) as qtd
FROM
impressao
WHERE
impressao.id_situacao = 1 and sessao='".$sessao."'
GROUP BY
impressao.codigo";

    $query = $mysqli->query($sql);
    
    $datos = array();
    
    while($resultado = $query->fetch_assoc()) {
        $datos[] = $resultado;
    }
    
    echo json_encode($datos);
    //echo json_encode(array("usuarios" => $datos));
?>
