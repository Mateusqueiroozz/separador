<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$_SESSION['conta'] = 0;
$sessao = session_id();
$impressora = $_SESSION['impressora'];
$loja = $_SESSION['loja'];
$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];
//echo $_SESSION['impressora'];
$_SESSION['ok'] = $_GET['ok'];

if ($tipo == "") {
	$_SESSION['tipo'] = "GONDOLA";
}

if ($impressora == "") {
	$nomeimpressora = "SELECIONAR IMPRESSORA";
	//$pp = $_GET['codigo'];
	//echo '<script> location.href = "impressora.php?pp=$pp";</script>';
}

if ($tipo == "") {
	$tipo = "GONDOLA";
}

if ($tipo == "GONDOLA") {
	$tipoimpressao = 'Impr. padrão';
}

if ($tipo == "ELGIN") {
	$tipoimpressao = 'Produto individual IMP ELGIN';
}

if ($tipo == "ETIQUETA") {
	$tipoimpressao =  'Produto individual';
}

include('conexao.php');

$consultaimp = mysqli_query($link, "SELECT * FROM impressora WHERE id='" . $impressora . "'");
$linhaimp = mysqli_fetch_array($consultaimp);

$nomeimpressora = $linhaimp['descricao'];
$_SESSION['nomeimpressora'] = $nomeimpressora;
//echo $nomeimpressora;
if ($nomeimpressora == "") {
	$nomeimpressora = "SELECIONAR IMPRESSORA";
	//$pp = $_GET['codigo'];
	//echo '<script> location.href = "impressora.php?pp=$pp";</script>';
}

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Reposição Mobile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
    <script src="/buscapreco/js/jquery.js"></script>
    <script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="/buscapreco/estilo.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/buscapreco/estilo.css" />
    <script src="dist/js/kc.fab.min.js"></script>
    <link rel="stylesheet" href="dist/css/kc.fab.css" />
</head>

<body>
    <div class="kc_fab_wrapper">

    </div>

    <script type="text/javascript">
    function desabilitar(valor) {
        var id_check = "check" + valor;
        var status2 = document.getElementById(id_check).checked;
        var id_campo = "qtd_solic" + valor;
        if (document.getElementById(id_check).checked) {
            document.getElementById(id_campo).removeAttribute("disabled");
        } else {
            document.getElementById(id_campo).setAttribute("disabled", "disabled")
            document.getElementById(id_campo).value = "";
        }
    }
    </script>

    <div>
        <div data-role="header" data-theme="b">
            <h2>Reposição Mobile</h2>
        </div>
        <div data-role="header" data-theme="a">
            <div class="" style="top: 0; right: 0">
                <a
                    class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right "><?php echo utf8_encode($nomeimpressora); ?></a>
                <a href="sair.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ">Sair</a>
            </div>
        </div>
        <div id="formulario">
            <form id="form_opcoes" action="reposicao_inserir.php" method="POST">
                <table data-role="table" id="listaimpressao" data-mode=""
                    class="ui-body-d ui-shadow table-stripe ui-responsive" style="font-size:14px"
                    data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
                    <tr>
                        <th class="tg-baqh" colspan="5" style="text-align:center;"><span style="color:#FE0000">Selecione
                                os itens para reposição e quantidade desejada</span></th>
                    </tr>
                    <tr>
                        <!--<td class="tabtitulo"></td>-->
                        <td class="tabtitulo"><strong>Rep.</strong></td>
                        <td class="tabtitulo"><strong>Codigo</strong></td>
                        <td class="tabtitulo"><strong>Produto</strong></td>
                        <td class="tabtitulo"><strong>Valor</strong></td>
                        <td class="tabtitulo"><strong>Qtd</strong></td>
                    </tr>

                    <?php
					$ordem = 0;
					$consultaimp = mysqli_query($link, "
	SELECT
impressao.data_hora,
impressao.tipo,
impressao.codigo,
concat(impressao.produto, ' ', impressao.complemento) as des,
impressao.valor,
impressao.id_situacao,
Sum(impressao.qtd) as qtd,
estloja10,
estloja20,
estloja30
FROM
impressao
WHERE
impressao.id_situacao = 1 and sessao='" . $sessao . "'

GROUP BY 
impressao.codigo

ORDER BY id desc");
					while ($linhaimp = mysqli_fetch_array($consultaimp)) {
						$ordem++;
					?>
                    <tr>
                        <td><input style="margin-top: -4px;" checked onchange="desabilitar(<?php echo $ordem; ?>)"
                                type="checkbox" name="item[]" id="check<?php echo $ordem; ?>"
                                value="<?php echo $linhaimp['codigo']; ?>" /><br></td>
                        <td id="produto"><?php echo $linhaimp['codigo']; ?></td>
                        <td style="width: 500px;"><input readonly type="text" style="text-align:center;"
                                value="<?php echo $linhaimp['des']; ?>" name="des[]" id="des<?php echo $ordem; ?>"><span
                                style="font-size: 8px;">ESTOQUE 10: <b><?php echo $linhaimp['estloja10']; ?></b> 20:
                                <b><?php echo $linhaimp['estloja20']; ?></b> 30:
                                <b><?php echo $linhaimp['estloja30']; ?></b></span></td>
                        <td>R$ <?php echo $linhaimp['valor']; ?></td>
                        <td style="width: 50px;"><input type="number" style="text-align:center; width: 50px;" value="0"
                                name="qtd_solic[]" id="qtd_solic<?php echo $ordem; ?>"></td>
                    </tr>
                    <?php
					}
					?>
                </table>
            </form>
        </div>
        <br>
        <section id="awesome-modal" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content rounded-0">
                    <div class="modal-header border-0 rounded-0">
                        <h5 class="modal-title">Confirma a reposição dos produtos abaixo?</h5>
                        <button style="width: 50px;" type="button" class="close cp" data-dismiss="modal">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body pt-0">

                        <form id="form_opcoes" action="reposicao_inserir.php" method="POST">

                            <table data-role="table" id="listaimpressao2" data-mode=""
                                class="ui-body-d ui-shadow table-stripe ui-responsive" style="font-size:14px"
                                data-column-btn-theme="b" data-column-btn-text="Columns to display..."
                                data-column-popup-theme="a">

                            </table>

                            <input class="btn btn-block btn-primary rounded-0" id="confirm-btn1" type="submit"
                                value="Confirmar">
                        </form>

                    </div>
                </div>
            </div>
        </section>
        <section class="container-fluid px-0">
            <button type="button" data-toggle="modal" data-target="#awesome-modal" class="btn btn-info rounded-2"
                id="btn_verificar" onclick="getElements()">Solicitar Reposição</button>
            <section>
                <form action="index.php" method="get" id="formprin" data-ajax="false">
                    <input name="n" value="<?php echo $_GET['n']; ?>" type="hidden">
                    <div class="pesquisar">
                        <input type="submit" value="Voltar" data-icon="" data-theme="a">
                    </div>
                </form>

                <script src="https://code.jquery.com/jquery-3.2.1.min.js"
                    integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous">
                </script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.bundle.min.js">
                </script>

                <script id="atualiza_modal">
                function getElements() {
                    var body = document.querySelector('#listaimpressao2');
                    body.innerHTML = "";
                    var choices = [];
                    var choices2 = [];
                    var choices3 = [];
                    var els = document.getElementsByName('item[]');
                    var els2 = document.getElementsByName('qtd_solic[]');
                    var els3 = document.getElementsByName('des[]');
                    for (var i = 0; i < els.length; i++) {
                        if (els[i].checked) choices.push(els[i].value);
                        if (els[i].checked) choices2.push(els2[i].value);
                        if (els[i].checked) choices3.push(els3[i].value);

                    }

                    //alert(res);
                    var body = document.querySelector('#listaimpressao2');
                    for (var i = 0; i < els.length; i++) {
                        if (i <= 0) {
                            if (els[i].checked) {
                                body.innerHTML +=
                                    "<tr><td class='tabtitulo'><strong>Produto</strong></td><td class='tabtitulo'><strong>Descricao</strong></td><td class='tabtitulo'><strong>Qtd</strong></td></tr>"
                                body.innerHTML +=
                                    "<tr><td id='elementos_reposicao' ><input class='form-control form-control-sm' aria-label='Small' type='text' name='item[]' id='item[]' readonly value='" +
                                    els[i].value +
                                    "' placeholder='.form-control-sm'></td><td><input class='form-control form-control-sm' type='text' name='desc[]' id='desc[]' readonly value='" +
                                    els3[i].value +
                                    "' placeholder='.form-control-sm'></td><td style='width: 50px;'><input class='form-control form-control-sm' type='text' name='qtd_solic[]' id='qtd_solic[]' readonly style='text-align: center; width: 75%;' value='" +
                                    els2[i].value + "' placeholder='.form-control-sm'></td></tr>";
                            }
                        } else {
                            if (els[i].checked) {
                                body.innerHTML +=
                                    "<tr><td id='elementos_reposicao' ><input class='form-control form-control-sm' aria-label='Small' type='text' name='item[]' readonly id='item[]' value='" +
                                    els[i].value +
                                    "' placeholder='.form-control-sm'></td><td><input class='form-control form-control-sm' type='text' name='desc[]' id='desc[]' readonly value='" +
                                    els3[i].value +
                                    "' placeholder='.form-control-sm'></td><td style='width: 50px;'><input class='form-control form-control-sm' type='text' name='qtd_solic[]' id='qtd_solic[]' readonly style='text-align: center; width: 75%;' value='" +
                                    els2[i].value + "' placeholder='.form-control-sm'></td></tr>";
                            }
                        }
                    }
                }
                let btn = document.getElementById('confirm-btn')

                if (!!btn) {
                    btn.addEventListener('click', function(evt) {
                        // para este exemplo
                        //alert('Confirmation button as been clicked!')
                        // redirecionamento
                        // location.replace('https://www.google.com')
                    }, false)
                }
                </script>
                <script>
                var principal = {};

                principal.start = function() {
                    $('#footer').css('position', 'static');
                };

                $(window).scroll(function() {
                    //var s = $(document.body)[0].scrollHeight;
                    var h = $(window).height();
                    s > h ? $('#footer').css('position', 'static') : $('#footer').css('position', 'fixed');;
                    //$('#footer').css('top',h-42); // CASO PRECISE DESCONTAR O NAVBAR
                    $('#footer').css('top', h); // PARA FIXAR O FOOTER NA PARTE INFERIOR DA PAGINA
                });

                principal.start();
                </script>
                <script>
                $(document).ready(function() {
                    var links = [{
                            "bgcolor": "red",
                            "icon": "+"
                        },
                        {
                            "url": "impressao_limpar.php",
                            "bgcolor": "red",
                            "color": "#fffff",
                            "icon": "<i class='fa fa-trash'></i>"
                        },

                        {
                            "url": "reposicao_solicitadas.php",
                            "bgcolor": "orange",
                            "color": "white",
                            "icon": "<i class='fas fa-scroll'></i>"
                        },
                        {
                            "url": "reposicao_selecao.php",
                            "bgcolor": "blue",
                            "color": "white",
                            "icon": "<i class='fa fa-shopping-cart'></i>",

                        },
                        {
                            "url": "impressao_imprimir.php",
                            "bgcolor": "green",
                            "color": "white",
                            "icon": "<i class='fas fa-print'></i>"
                        },


                    ]
                    $('.kc_fab_wrapper').kc_fab(links);
                })
                </script>


    </div>

</body>



</html>