<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$string = $_POST['forne'];
$loja   = $_POST['loja'];
$cod    = $_POST['cod'];


foreach ($string as $num) {
	//$num_cor = substr_replace($num, "'",0,0);

	$num_cor = substr_replace($num, "'", 0, 0);

	//echo $num_cor;

	$string_cor = $string_cor . $num_cor . "',";
}
//echo $string_cor;
$string_cor = substr($string_cor, 0, -1);
echo $string_cor;

include('conexaooracle.php');
include('conexao.php');
require_once './libraries/PHPExcel.php';
$sql = "select 
	t522_unidade_ie as Loja,
	t522_seq_balanco_ie as codinventario,
	t523_seq_item_balanco_ie as seqitem,
	T522_PRODUTO_E as COD,
	t076_descricao as descricao,
	t076_apresentacao as apresentacao,
	t523_tipo_acerto as tipo_acerto,
	t523_quantidade_acerto as qtd_acerto,
	t076_industria_e as fornecedor,
	T523_QTDE_ESTOQUE_REF_ACERTO as estoque_contagem,
	T523_QTDE_CONTADA_INICIAL as contado
	from t522_balanco_unidade_itens, t523_balanco_unid_itens_lotes, t076_produto
	where t522_seq_item_balanco_iu = t523_seq_item_balanco_ie
	and t522_unidade_ie = t523_unidade_ie
	and t522_seq_balanco_ie = t523_seq_balanco_ie
	and t076_produto_iu = t522_produto_e
	and t522_unidade_ie = " . $loja . "
	and t076_industria_e in (" . $string_cor . ")
	and t522_seq_balanco_ie > " . $cod;



$resultado = oci_parse($conexao, $sql) or die("erro");
oci_execute($resultado);

$sql_truncate = "TRUNCATE TABLE tb_temp_1";
$insert = mysqli_query($link, $sql_truncate);
$sql_truncate2 = "TRUNCATE TABLE tb_temp_2";
$insert = mysqli_query($link, $sql_truncate2);

while ($v_pagina = oci_fetch($resultado)) {
	$mdlog = oci_result($resultado, 'COD');
	$update = "INSERT INTO tb_temp_1 (mdlog) VALUES ('$mdlog')";
	$insert = mysqli_query($link, $update);
}

include('conexaoPDO.php');
$pdo = new Conexao();

$sql_wc = "SELECT codbar.c_codbar as cod_bar,
		trim(prod.c_codinteg) as cod_integ,
		prod.c_descr || ' ' || prod.c_compl as descricao,
		ende.c_local as endereco,
		est.c_estloja as est
		FROM a_produt prod
		INNER JOIN a_estfil est ON (est.c_codprod = prod.c_codigo)
		INNER JOIN a_fornec forn ON (prod.c_fornec = forn.c_codigo)
		INNER JOIN a_codbar codbar ON (prod.c_codigo = codbar.c_codprod)
		LEFT JOIN a_endpro ende ON (prod.c_codigo = ende.c_codprod and est.c_fil = ende.c_fil) WHERE est.c_fil ='" . $loja . "'
		and forn.c_codinteg IN(" . $string_cor . ")
		and est.c_estloja > '0'
		ORDER BY 2 ASC";

$result = $pdo->select($sql_wc);
foreach ($result as $item) {
	$cod_mdlog = $item['cod_integ'];
	$sql_consulta = "SELECT mdlog FROM tb_temp_1 WHERE mdlog = $cod_mdlog group by 1";

	$result2 = mysqli_query($link, $sql_consulta);
	$row_cnt = mysqli_num_rows($result2);
	if ($row_cnt > 0) {
	} else {
		$sql_insere_tb2 = "INSERT INTO tb_temp_2 (mdlog) VALUES ('$cod_mdlog')";
		$insert = mysqli_query($link, $sql_insere_tb2);
	}
}

$sql_consulta_tb2 = "SELECT mdlog FROM tb_temp_2 GROUP BY 1";
$insert = mysqli_query($link, $sql_consulta_tb2);

$ultimacelula = 'D';
//criando um objeto do tipo PHPEXCEL
$objPHPExcel = new PHPExcel();
//nomeando a planilha do objeto criado
$myWorkSheet = new PHPExcel_Worksheet($objPHPExcel, 'GradeEndereco');
//adicionando planilha ao objeto
$objPHPExcel->addSheet($myWorkSheet, 0);
//selecionando planilha pelo nome
$sheetIndex = $objPHPExcel->getIndex($objPHPExcel->getSheetByName('Worksheet'));
//apagando planilha vazia pelo nome
$objPHPExcel->removeSheetByIndex($sheetIndex);
//setando os titulos dos registros
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'GRADE COM ENDERECOS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A2', 'BARRAS');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B2', 'MDLOG');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C2', 'DESCRICAO');
$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D2', 'ENDERECO');

//numero da linha em que começa a insercao dos registros
$linha = 3;

//setando formatacao das colunas
$objPHPExcel->getActiveSheet()->getStyle('A')->getNumberFormat()->setFormatCode("0000000000000");
$objPHPExcel->getActiveSheet()->getStyle('B')->getNumberFormat()->setFormatCode("000000");
$objPHPExcel->getActiveSheet()->getStyle('A2:' . $ultimacelula . '2')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('708090');
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('DCDCDC');
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension($ultimacelula)->setAutoSize(true);

//mescla as celulas do cabecalho
$objPHPExcel->getActiveSheet()->mergeCells('A1:' . $ultimacelula . '1');

//setando negrito para o cabecalho
$objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

//setando tamanho das colunas automatico
$objPHPExcel->getActiveSheet()->getStyle('A2:' . $ultimacelula . '2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A:D')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);

//setando negrito para os titulos
$objPHPExcel->getActiveSheet()->getStyle('A2:' . $ultimacelula . '2')->getFont()->setBold(true);

//varrendo a array com os registro, inserindo estilos das celulas, formatacao e  inserindo registros na planilha linha por linha
foreach ($insert as $item) {
	$cod_mdlog = $item['mdlog'];

	$sql_consulta_grade = "SELECT codbar.c_codbar as cod_bar,
				trim(prod.c_codinteg) as cod_integ,
				prod.c_descr || ' ' || prod.c_compl as descricao,
				ende.c_local as endereco,
				est.c_estloja as est
				FROM a_produt prod
				INNER JOIN a_estfil est ON (est.c_codprod = prod.c_codigo)
				INNER JOIN a_fornec forn ON (prod.c_fornec = forn.c_codigo)
				INNER JOIN a_codbar codbar ON (prod.c_codigo = codbar.c_codprod)
				LEFT JOIN a_endpro ende ON (prod.c_codigo = ende.c_codprod and est.c_fil = ende.c_fil) WHERE est.c_fil ='" . $loja . "'
				and prod.c_codinteg IN('" . $cod_mdlog . "')
				ORDER BY 2 ASC";

	$result = $pdo->select($sql_consulta_grade);
	foreach ($result as $item_prod) {
		//inserindo registros na planilha		
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('A' . $linha, ($item_prod['cod_bar']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('B' . $linha, ($item_prod['cod_integ']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('C' . $linha, ($item_prod['descricao']));
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D' . $linha, ($item_prod['endereco']));
		//passa para a proxima linha
		$linha++;
	}
}
$qtdlinha = $linha - 1;

$styleArray = array(
	'borders' => array(
		'allborders' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);

//executa funcao para aplicar as bordas
$objPHPExcel->getActiveSheet()->getStyle('A3:' . $ultimacelula . $qtdlinha)->applyFromArray($styleArray);

$objPHPExcel->getActiveSheet()->getStyle('A1:' . $ultimacelula . '2')->applyFromArray($styleArray);
unset($styleArray);

//salva o nome do arquivo
$nomearquivo = "sembalanco.xlsx";

//seta o tipo de arquivo que irá ser salvo	
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');

if (file_exists('./arquivos_sem_bal/' . $nomearquivo)) {
	unlink('./arquivos_sem_bal/' . $nomearquivo);
}

//salva o arquivo no servidor
$objWriter->save("./arquivos_sem_bal/$nomearquivo");

//faz o download do arquivo gerado acima
header("Location: ./arquivos_sem_bal/$nomearquivo");