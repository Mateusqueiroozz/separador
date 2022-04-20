<?php
//session_start();
$loja = $_SESSION['loja'];
$pdo = new PDO("pgsql:host=192.168.254.205;dbname=ceprd", "icomp", "icompdbpw");
if ($tipo_documento == 'orcamento') {
    $sql = "SELECT 
    orc.c_seq as sequencia,
    pro.c_unidade as unidade,
    pro.c_codbar as cod_bar,
    orc.c_quant as quantidade,
    pro.c_descr || ' ' || pro.c_compl as descricao,
    orc.c_preco as preco_unitario,
    orc.c_quant * orc.c_preco as preco_total,
    pro.c_codinteg as cod_mdlog,
    orc1.c_vended || ' - ' || ven.c_apelido as vendedor
    from a_orcam2 orc
    LEFT JOIN a_produt pro  ON (orc.c_codprod = pro.c_codigo)
    LEFT JOIN a_orcam1 orc1 ON (orc.c_numero = orc1.c_numero and orc.c_fil = orc1.c_fil)
	LEFT JOIN a_vended ven  ON (orc1.c_vended = ven.c_codigo)
    where orc.c_numero = '$documento' and orc.c_fil = '$loja'
    AND orc.c_cancel = false
    order by 1 asc";
} else {
    $sql = "SELECT 
    pre.c_seq as sequencia,
    pro.c_unidade as unidade,
    pro.c_codbar as cod_bar,
    pre.c_quant as quantidade,
    pro.c_descr || ' ' || pro.c_compl as descricao,
    pre.c_preco as preco_unitario,
    pre.c_quant * pre.c_preco as preco_total,
    pro.c_codinteg as cod_mdlog,
    pre1.c_vended || ' - ' || ven.c_apelido as vendedor
    from a_preve2 pre
    left join a_produt pro  ON (pre.c_codprod = pro.c_codigo)
    left join a_preve1 pre1 ON (pre.c_numero = pre1.c_numero and pre.c_fil = pre1.c_fil)
	left join a_vended ven  ON (ven.c_codigo = pre1.c_vended)
    where trim(pre.c_numero) = '$documento' and pre.c_fil = '$loja'
    AND pre.c_cancel = false
    order by 1 asc";
}

$result = $pdo->prepare($sql);
