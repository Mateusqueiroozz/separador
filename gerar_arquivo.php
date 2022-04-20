<?php
include('conexao.php');
$sql = "SELECT *,at.id as id_atendimento, concat(aten.codigo, ' - ', aten.nome) as atendente, case when at.loja = '10' then '10 - COHAMA' when at.loja = '20' then '20 - SAO FRANCISO' when at.loja = '30' then '30 - GUAJAJARAS' end as loja_nome FROM atendimentos at left join atendentes aten on (at.id_atendente = aten.id) WHERE cod_documento = '$documento'";
$resultado = mysqli_query($link, $sql);


foreach ($resultado as $item) {
    $id_at = $item['id_atendimento'];
    $atendente = $item['atendente'];
    $loja = $item['loja_nome'];
    $vendedor = $item['vendedor'];
}
date_default_timezone_set('America/Sao_Paulo');
$data = date('d/m/Y H:i:s');

$sql = "SELECT * FROM atendimentos_produtos WHERE id_atendimento = '$id_at'";

$resultado_produtos = mysqli_query($link2, $sql);

$quebra = "\n";
$texto = 'x0E W1J. GONCALVES DOS SANTOS FILHO E CIA LTDAW0  F';
$texto .= $quebra;
$texto .= 'LOJA.: ' . $loja . '   ATENDENTE.: ' . $atendente .     '  Emissao.: ' . $data . '  Vendedor.: ' . $vendedor . '';
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;
$texto .= 'W1    *** DOCUMENTO  N: ' . $documento . '*** W0';
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;
$texto .= 'CodMdlog    Cod Barras          UND QTD            Descricao do Produto                                       Localizacao     ';
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;

foreach ($resultado_produtos as $item) {

    $id_produto = $item['id'];
    $cod_mdlog = str_replace(' ', '', $item['cod_mdlog']);
    $cod_bar_principal = $item['cod_bar'];
    $unidade = $item['unidade'];
    $quantidade = $item['quantidade'];
    $descricao = substr($item['descricao'], 0, 42);
    $count_descricao = strlen($descricao);
    $count_codmdlog = strlen($cod_mdlog);
    $count_qtd = strlen($quantidade);
    $tamanho_descricao = 42;
    $tamanho_cod_mdlog = 8;
    $tamanho_qtd = 9;

    if ($count_descricao < $tamanho_descricao) {
        $dif = $tamanho_descricao - $count_descricao;
        for ($count = 0; $count < $dif; $count++) {
            $descricao .= ' ';
        }
    }
    if ($count_codmdlog < $tamanho_cod_mdlog) {
        $dif = $tamanho_cod_mdlog - $count_codmdlog;
        for ($count = 0; $count <= $dif; $count++) {
            $cod_mdlog .= ' ';
        }
    }
    if ($count_qtd < $tamanho_qtd) {
        $dif = $tamanho_qtd - $count_qtd;
        for ($count = 0; $count <= $dif; $count++) {
            $quantidade .= ' ';
        }
    }
    //echo 'descricao: ' . $descricao . '.';
    //echo '<br>';
    $texto .= '' . $cod_mdlog . '   ' . $cod_bar_principal . '     ' . $unidade . ' ' . $quantidade . '     ' . $descricao . '      ';
    $sql_endereco = "SELECT endereco as endereco FROM endereco WHERE id_produto = $id_produto  GROUP BY 1";
    $resultado_endereco = mysqli_query($link4, $sql_endereco);
    $qtd_endereco = mysqli_num_rows($resultado_endereco);
    $sql_grade = "SELECT cod_bar as cod_bar FROM grade WHERE id_produto = $id_produto and cod_bar <>  '$cod_bar_principal'  GROUP BY 1";
    //echo 'sql grade: ' . $sql_grade;
    //echo '<br>';
    $resultado_grade = mysqli_query($link5, $sql_grade);
    $qtd_grade = mysqli_num_rows($resultado_grade);

    //echo 'qtd_grade: ' . $qtd_grade;
    //echo '<br>';
    //echo 'qtd_endereco: ' . $qtd_endereco;
    //echo '<br>';

    if ($qtd_endereco == 1 && $qtd_grade == 1) {
        foreach ($resultado_endereco as $item) {

            $texto .= '          ' . $item['endereco'] . '     ';
            foreach ($resultado_grade as $item2) {
                $texto .= $quebra;
                $texto .= '            ' . $item2['cod_bar'];
            }
        }
    } else if ($qtd_endereco > 1) {
        $cont = 0;
        $ultimo_endereco = '';
        foreach ($resultado_endereco as $item) {
            while ($linha = mysqli_fetch_array($resultado_grade)) {
                //$row = mysqli_fetch_row($resultado_grade);

                $ultimo_endereco .= $item['endereco'];


                if ($cont == 0) {
                    $texto .= '          ' . $item['endereco'] . '     ';
                    $texto .= $quebra;
                    $texto .= '            ' . $linha['cod_bar'] . '                                                            ';
                    $endereco_restante = retornaEndereco($id_produto, $item['endereco']);
                    $texto .= '                 ' . $endereco_restante . '     ';
                    $cont++;
                } else {
                    $texto .= $quebra;
                    $texto .= '            ' . $linha['cod_bar'] . '                                                            ';
                    $endereco_restante = retornaEndereco($id_produto, $ultimo_endereco);
                    $texto .= '                 ' . $endereco_restante . '     ';
                    $cont++;
                }
                $ultimo_endereco .= "','" . $endereco_restante . "','";
            }
        }
    } else if ($qtd_endereco == 1 && $qtd_grade == 0) {
        foreach ($resultado_endereco as $item) {

            $texto .= '          ' . $item['endereco'] . '     ';
            foreach ($resultado_grade as $item2) {
                $texto .= $quebra;
            }
        }
    }
    if ($qtd_endereco > 1 && $qtd_grade == 0) {
        foreach ($resultado_endereco as $item) {
            $ultimo_endereco .= $item['endereco'];

            if ($cont == 0) {
                $texto .= '          ' . $item['endereco'] . '     ';
                $texto .= $quebra;
                $texto .= '                                                                                            ';
                $endereco_restante = retornaEndereco($id_produto, $item['endereco']);
                $texto .= '                 ' . $endereco_restante . '     ';
                $cont++;
            } else {
                $texto .= $quebra;
                $texto .= '                                                                                            ';
                $endereco_restante = retornaEndereco($id_produto, $ultimo_endereco);
                $texto .= '                 ' . $endereco_restante . '     ';
                $cont++;
            }
            $ultimo_endereco .= "','" . $endereco_restante . "','";
        }
    } else if ($qtd_endereco == 1 && $qtd_grade > 1) {
        $cont = 0;
        foreach ($resultado_endereco as $item) {
            while ($linha = mysqli_fetch_array($resultado_grade)) {
                //$row = mysqli_fetch_row($resultado_grade);

                if (isset($ultimo_endereco)) {
                    $ultimo_endereco .= $item['endereco'];
                }
                if ($cont == 0) {
                    $texto .= '          ' . $item['endereco'] . '     ';
                    $texto .= $quebra;
                    $texto .= '            ' . $linha['cod_bar'] . '                                                            ';
                    //$endereco_restante = retornaEndereco($id_produto, $item['endereco']);
                    //$texto .= '                ' . $endereco_restante . '     ';
                    $cont++;
                } else {
                    $texto .= $quebra;
                    $texto .= '            ' . $linha['cod_bar'] . '                                                            ';
                    //$endereco_restante = retornaEndereco($id_produto, $ultimo_endereco);
                    if (isset($endereco_restante)) {
                        $texto .= '                ' . $endereco_restante . '     ';
                    }
                    $cont++;
                }
                //$ultimo_endereco .= "','" . $endereco_restante . "','";
            }
        }
    }
    $texto .= $quebra;
}
$texto .= $quebra;
$texto .= 'Observacoes';
$texto .= $quebra;
$texto .= $quebra;
$texto .= $quebra;
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;
$texto .= 'x0E W1J. GONCALVES DOS SANTOS FILHO E CIA LTDAW0  F';
$texto .= $quebra;
$texto .= 'LOJA.: ' . $loja . '   ATENDENTE.: ' . $atendente .     '  Emissao.: ' . $data . '  Vendedor.: ' . $vendedor . '';
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;
$texto .= 'W1    *** DOCUMENTO  N: ' . $documento . '*** W0';
$texto .= $quebra;
$texto .= '------------------------------------------------------------------------------------------------------------------------------';
$texto .= $quebra;
$texto .= '

';

$nomearquivo = "impressao/imp_" . $impressora . "_" . $documento .  ".txt";
if (file_exists($nomearquivo)) {
    unlink($nomearquivo);
}
$fp = fopen($nomearquivo, "w+");
$escreve = fwrite($fp, $quebra . $texto);
fclose($fp);

function retornaEndereco($id_produto, $ultimo_endereco)
{
    include('conexao.php');
    $sql_endereco = "SELECT endereco as endereco FROM endereco WHERE id_produto = $id_produto and endereco not in  ('$ultimo_endereco') GROUP BY 1 limit 1";
    //echo 'sql funcao: ' . $sql_endereco;
    $resultado_endereco = mysqli_query($link4, $sql_endereco);
    $row = mysqli_fetch_row($resultado_endereco);

    if (isset($row[0])) {
        return $row['0'];
    } else {
        return '';
    }
}