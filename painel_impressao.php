<?php
session_start();
if (isset($_POST['tipo_atendimento']) && isset($_POST['tipo_documento'])) {
    $doc = 0;
    include('conexao.php');
    $sql_consulta_reposicao = "SELECT * FROM atendimentos WHERE cod_documento ='" . $_POST['documento'] . "'";
    $resultado = mysqli_query($link, $sql_consulta_reposicao);
    while ($linha = mysqli_fetch_array($resultado)) {
        $doc = 1;
    }
    if ($doc == 0) {
        if ($_POST['impressao'] == 'sim') {
            $impressora = $_POST['impressora'];
        } else {
            $impressora = 0;
        }
        $loja = $_SESSION['loja'];
        consultaDocumento($_POST['documento'], $impressora, $_POST['tipo_atendimento'], $_POST['atendente'], $_POST['tipo_documento'], $loja);
    } else {
        echo "Documento já separado.";
    }
}

function consultaDocumento($documento, $impressora, $tipo_atendimento, $atendente, $tipo_documento, $loja)
{
    include('sql_consulta_documento.php');

    $result->execute();
    //$result = $pdo->select($sql);
    $linhas = 0;
    $linhas = $result->rowCount();
    include('conexao.php');
    if ($linhas > 0) {
        $vendedor = '000';

        $sql_insert = "INSERT INTO atendimentos (cod_documento, inicio_separacao, id_atendente, situacao, tipo_atendimento, qtd_itens, loja, vendedor) VALUES ('$documento', NOW(), '$atendente', 'A', '$tipo_atendimento', '$linhas', '$loja', '$vendedor')";
        mysqli_query($link, $sql_insert);
        if (mysqli_errno($link)) {
            echo "<script language='javascript' type='text/javascript'>
        alert('ERRO AO GRAVAR DADOS DO DOCUMENTO. ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA');window.location
        .href='painel_index.php';</script>";
        } else {
            $id_atendimento = mysqli_insert_id($link);
        }

        foreach ($result as $item) {
            $sequencia =      $item['sequencia'];
            $cod_bar =        $item['cod_bar'];
            $unidade =        $item['unidade'];
            $quantidade =     $item['quantidade'];
            $descricao =      $item['descricao'];
            $preco_unitario = $item['preco_unitario'];
            $preco_total =    $item['preco_total'];
            if (isset($item['endereco'])) {
                $endereco =       $item['endereco'];
            } else {
                $endereco = " ";
            }
            $cod_mdlog =      $item['cod_mdlog'];
            $vendedor =      $item['vendedor'];

            $sql_insert = "INSERT INTO atendimentos_produtos (seq, cod_bar, unidade, quantidade, descricao, vl_unitario, vl_total, cod_mdlog, id_atendimento) VALUES ('$sequencia', '$cod_bar', '$unidade', '$quantidade', '$descricao', '$preco_unitario', '$preco_total', '$cod_mdlog','$id_atendimento')";
            mysqli_query($link2, $sql_insert);
            if (mysqli_errno($link2)) {
                echo "<script language='javascript' type='text/javascript'>
        alert('ERRO AO GRAVAR SEPARACAO NO SISTEMA. ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA.');window.location
        .href='painel_index.php';</script>";
            } else {
                $id_produto = mysqli_insert_id($link2);
                insereEndereco($cod_mdlog, $loja, $id_produto);
                insereGrade($cod_mdlog, $id_produto);
            }
        }
        $sql_update = "UPDATE atendimentos SET vendedor = '$vendedor' WHERE cod_documento = '$documento' AND loja = '$loja'";
        mysqli_query($link5, $sql_update);

        include('gerar_arquivo.php');

        echo "Separação iniciada com sucesso.";
    } else {
        echo "Documento não encontrado.";
    }
}
function insereEndereco($cod_mdlog, $loja, $id_produto)
{
    include('sql_consulta_endereco.php');
    $result2->execute();
    $linhas_endereco = 0;
    $linhas_endereco = $result2->rowCount();
    include('conexao.php');
    if ($linhas_endereco > 0) {
        foreach ($result2 as $item2) {
            $endereco = $item2['endereco'];
            $sql_insert_endereco = "INSERT INTO endereco (endereco, id_produto) VALUES ('$endereco', '$id_produto')";
            mysqli_query($link3, $sql_insert_endereco);
            if (mysqli_errno($link3)) {
                echo "<script language='javascript' type='text/javascript'>
                alert('ERRO AO GRAVAR ENDERECO DOS PRODUTOS. ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA');window.location
                .href='painel_index.php';</script>";
            }
        }
    }
}
function insereGrade($cod_mdlog, $id_produto)
{

    include('sql_consulta_grade.php');
    $result3->execute();
    $linhas_grade = 0;
    $linhas_grade = $result3->rowCount();
    if ($linhas_grade > 0) {
        include('conexao.php');
        foreach ($result3 as $item3) {
            $cod_bar = $item3['cod_bar'];
            $sql_insert_grade = "INSERT INTO grade (cod_bar, id_produto) VALUES ('$cod_bar', '$id_produto')";
            mysqli_query($link4, $sql_insert_grade);
            if (mysqli_errno($link4)) {
                echo "<script language='javascript' type='text/javascript'>
    alert('ERRO AO GRAVAR GRADE DOS PRODUTOS. ENTRAR EM CONTATO COM O ADMINISTRADOR DO SISTEMA');window.location
    .href='painel_index.php';</script>";
            }
        }
    }
}