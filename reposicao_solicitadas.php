<?php
date_default_timezone_set('America/Sao_Paulo');
session_start();
date_default_timezone_set('America/Sao_Paulo');
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$loja = $_SESSION['loja'];
$usuario1 = $_SESSION['usuario'];
$nomeimpressora = $_SESSION['nomeimpressora'];
$sessao = session_id();
include('conexao.php');
$usuario_cookie = $_COOKIE['usuario'];
if (isset($usuario_cookie)) {
	$ok = 1;
} else {
	$ok = 0;
}
if ($ok == 1) {

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
    <script src="/buscapreco/js/jquery.js"></script>
    <script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="/buscapreco/estilo.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/kc.fab.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="dist/js/kc.fab.min.js"></script>



</head>

<body>

    <div class="kc_fab_wrapper">
    </div>



    <div data-role="header" data-theme="b">
        <h2>Repos. Solicitadas</h2>

    </div>

    <div data-role="header" data-theme="a">
        <div class="" style="top: 0; right: 0">
            <a
                class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right "><?php echo utf8_encode($nomeimpressora); ?></a>
            <a href="sair.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ">Sair</a>
        </div>
    </div>

    <table data-role="table" id="listaimpressao" data-mode="" class="ui-body-d ui-shadow table-stripe ui-responsive"
        style="font-size:14px" data-column-btn-theme="b" data-column-btn-text="Columns to display..."
        data-column-popup-theme="a">
        <tr>
            <!--<td class="tabtitulo"></td>-->
            <td class="tabtitulo"><strong>Id</strong></td>
            <td class="tabtitulo"><strong>Dt. Solic.</strong></td>
            <td class="tabtitulo"><strong>Itens</strong></td>
            <td class="tabtitulo"><strong>Situacao</strong></td>
        </tr>

        <?php
			$ordem = 0;
			$data_atual = date('Y/m/d H:i:s');
			$data_inicial = date('Y/m/d 00:00:00', strtotime('-7 days', strtotime($data_atual)));
			$sql = "SELECT id as id, dthora_solic as dthora_solic, qtd_itens as qtd_itens, case WHEN situacao = 'A' then 'Aguardando Separação' 
		when situacao = 'B' then 'Em separação'
		when situacao = 'C' then 'Aguardando coleta'
		end as situacao  FROM t_repos1
		WHERE user_solic = '$usuario1' 
		and loja = '$loja' and dthora_solic BETWEEN '$data_inicial' and '$data_atual'
		order by 2 desc";
			$consultaimp = mysqli_query($link, $sql);

			function converterData($data)
			{
				$dInicio = new DateTime($data);
				$dFim  	 = new DateTime();
				$dDiff   = $dInicio->diff($dFim);
				$dias    = $dDiff->days;

				if ($dias == 0) {
					return 'Hoje às ' . $dInicio->format('H:i');
				} else if ($dias == 1) {
					return 'Ontem às ' . $dInicio->format('H:i');
				}

				return $dInicio->format('d/m/Y') . ' às ' . $dInicio->format('H:i');
			}



			while ($linhaimp = mysqli_fetch_array($consultaimp)) {
				$ordem++;
			?>
        <tr>
            <!--<td width="23"><b><?php echo $ordem; ?></b></td>-->
            <td><?php echo $linhaimp['id']; ?></td>
            <td><?php echo converterData($linhaimp['dthora_solic']); ?></td>
            <td><?php echo $linhaimp['qtd_itens']; ?></td>
            <td><?php echo $linhaimp['situacao']; ?></td>
        </tr>

        <?php

			}

			?>
    </table>

    <br>
    <div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="b" data-dismissible="false"
        style="max-width:400px;">
        <div data-role="header" data-theme="a">
            <h1 style="margin:0">Limpar lista de impressão?</h1>
        </div>
        <div role="main" class="ui-content" style="text-align:center">
            <h3 class="ui-title">Tem certeza que deseja apagar tudo?</h3>
            <p style="display:none">This action cannot be undone.</p>
            <a href="index.php" style="background-color: green;"
                class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Não</a>
            <a href="impressao_limpar.php" style="background-color: red;"
                class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" data-rel=""
                data-transition="flow">Sim</a>
        </div>


        <script>
        window.onload = function() {
            var principal2 = {};

            principal2.start = function() {
                $('#footer').css('position', 'static');
            };

            $(window).scroll(function() {
                //var s = $(document.body)[0].scrollHeight;
                var h = $(window).height();
                s > h ? $('#footer').css('position', 'static') : $('#footer').css('position', 'fixed');;
                //$('#footer').css('top',h-42); // CASO PRECISE DESCONTAR O NAVBAR
                $('#footer').css('top', h); // PARA FIXAR O FOOTER NA PARTE INFERIOR DA PAGINA
            });

            principal2.start();


        }
        </script>
        <script>
        $(document).ready(function() {
            var links2 = [{
                "url": "index.php",
                "bgcolor": "green",
                "color": "#fffff",
                "icon": "<i class='fa fa-home'></i>"
            }]
            $('.kc_fab_wrapper').kc_fab(links2);
        })

        //
        </script>

</body>

</html>
<?php } else {
	header("Location: login.html");
}
?>