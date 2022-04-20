<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
$usuario_cookie = $_COOKIE['usuario'];
if (isset($usuario_cookie)) {
	$ok = 1;
} else {
	$ok = 0;
}
if ($ok == 1) {
	$sessao = session_id();
	$impressora = $_SESSION['impressora'];
	$tipo = $_SESSION['tipo'];
	$usuario = $_SESSION['user'];

	//echo $_SESSION['impressora'];
	//$_SESSION['ok'] = $_GET['ok'];

	if ($tipo == "") {
		$_SESSION['tipo'] = "GONDOLA";
		$tipo = "GONDOLA";
		$tipoimpressao = 'Impressão padrão';
	}

	if ($impressora == "") {
		echo "<script language='javascript' type='text/javascript'>
        alert('Selecione a impressora');window.location
        .href='entrar_loja.php';</script>";
		//$pp = $_GET['codigo'];
		//echo '<script> location.href = "impressora.php?pp=$pp";</script>';
	}

	include('conexao.php');

	//impressora
	$consultaimp = mysqli_query($link, "SELECT * FROM impressora WHERE id='" . $impressora . "'");
	$linhaimp = mysqli_fetch_array($consultaimp);

	$nomeimpressora = $linhaimp['descricao'];
	$_SESSION['nomeimpressora'] = $nomeimpressora;

	if ($nomeimpressora == "") {
		echo "<script language='javascript' type='text/javascript'>
        alert('Selecione a impressora');window.location
        .href='entrar_loja.php';</script>";
	}

?>


<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Centro Repositor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    <link rel="stylesheet" href="estilo.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="dist/css/kc.fab.css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="dist/js/kc.fab.min.js"></script>


    <script>
    function contador() {
        var str = $("#codigo").val();
        // var str = "Hello World!";
        var n = str.length;
        // document.getElementById("demo").innerHTML = n;


        if (n > 12) {
            //alert(n);
            $("#formprin").submit();
        }


    }
    </script>
</head>

<body>
    <div class="kc_fab_wrapper">

    </div>


    <div data-role="header" data-theme="b">
        <h2>Centro Repositor</h2>

        <div class="btn-group pull-right" style="position: absolute;top: 0; right: 0">
        </div>

    </div>
    <div data-role="header" data-theme="a">
        <div class="" style="top: 0; right: 0">
            <a class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ">
                <?php
					echo utf8_encode($nomeimpressora);
					?>
            </a>

            <a href="sair.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ">Sair</a>
        </div>
    </div>

    <div>

        <form action="index.php" method="get" id="formprin" data-ajax="false">
            <input type="number" style="text-align:center" name="codigo" id="codigo" autocomplete="off"
                onDblClick="this.value = ''" placeholder="Digite o código de barras aqui" autofocus>
            <input name="n" value="<?php echo $_GET['n']; ?>" type="hidden">
            <select onChange="location.href = 'impressao_auto.php'" name="slider-flip-m" id="slider-flip-m"
                data-role="slider" data-mini="true" title="Automatico ou manual">
                <?php
					if ($_SESSION['auto'] == 1) {

						echo '<option value="off">M</option>
    <option value="on" selected="">A</option>';
					} else {
						echo '<option value="off"  selected="">M</option>
    <option value="on">A</option>';
					}

					?>
            </select>
            </select>
            <div class="pesquisar">
                <input type="submit" value="PESQUISAR" data-icon="" data-theme="a">

            </div>
        </form>
    </div>
    <?php
		//echo $_SESSION['tipo'];
		?>

    <?php

		$codigo = $_GET['codigo'];

		//echo $codigo;

		if ($codigo > 0) {

			if ($_GET["n"] == 1) {
			} else {

				echo "<div class='sim'>";

				include('conexaoPDO.php');

				$pdo = new Conexao();

				$sql1 = "SELECT
				(a_codbar.c_codbar) AS barras,
				(a_codbar.c_codbar) AS barras2,
				a_produt.c_descr AS  descricao,				
				a_produt.c_compl AS  complemento,
				a_produt.c_codncm AS ncm,
				a_produt.c_codinteg AS codmdlog,
				ROUND(a_precos.c_prvend01,2)  AS preco,
				case when stk.c_fil = '10' then  stk.c_estloja else 0 end as  estloja10,
				case when stk.c_fil = '20' then  stk.c_estloja else 0 end as  estloja20,
				case when stk.c_fil = '30' then  stk.c_estloja else 0 end as  estloja30				
				FROM
					a_produt
				LEFT JOIN a_precos ON (a_produt.c_codigo = a_precos.c_codprod)
				LEFT JOIN a_codbar ON (a_codbar.c_codprod = a_produt.c_codigo)				
				LEFT JOIN a_estfil stk ON (stk.c_codprod = a_produt.c_codigo)
				WHERE (a_precos.c_fil = '10') 
				and	(a_produt.c_codigo = a_codbar.c_codprod) 
				and a_codbar.c_codbar = '$codigo' LIMIT 1";

				//$consultaprd = mysqli_query($link,"SELECT * FROM produto WHERE(codigo1='".$codigo."' OR codigo2='".$codigo."') ORDER BY valor DESC LIMIT 1");

				$result1 = $pdo->select($sql1);

				//varrendo a array com os registro, inserindo estilos das celulas, formatacao e  inserindo registros na planilha linha por linha
				include('conexaooracle.php');
				foreach ($result1 as $item1) {

					//inserindo registros na planilha			
					$barras = 		$item1['barras'];
					$barras2 = 		$item1['barras2'];
					$descricao = 	$item1['descricao'];
					$complemento =  $item1['complemento'];
					$ncm = 		    $item1['ncm'];
					$codmdlog = 	$item1['codmdlog'];
					$preco  = 		$item1['preco'];

					$estloja10 = 	$item1['estloja10'];
					$estloja20 = 	$item1['estloja20'];
					$estloja30 = 	$item1['estloja30'];

					$sql = "SELECT hp.T781_VLR_ANTIGO as ANTIGO, 
					hp.T781_VLR_NOVO as NOVO 
					from T781_HISTORICO_PRECO hp
					where hp.T781_PRODUTO_IE =" . $codmdlog . "
					and hp.T781_UNIDADE_IE = 10
					and hp.T781_VLR_NOVO = " . $preco . "and ROWNUM <= 1";

					$resultado = oci_parse($conn, $sql) or die("erro");
					oci_execute($resultado);

					while ($v_pagina = oci_fetch($resultado)) {
						$pr_antigo = oci_result($resultado, 'ANTIGO');
						$pr_novo = oci_result($resultado, 'NOVO');

						if ($preco == $pr_antigo) {
							$mudou = 'N';
						} else {
							$mudou = 'S';
						}
						//echo $mudou;
					}

					//mysqli_query($link, "INSERT INTO impressao (sessao, id_impressora, data_hora, codigo, produto, complemento, valor, id_situacao,qtd,tipo) VALUES ('".$sessao."', '".$impressora."',NOW(), '".$barras ."', '".$descricao."', '".$complemento."', '".$preco."', '1','1','".$tipo."')");
					if ($mudou == 'S') {
						echo '
	<form action="impressao_add.php" method="get" id="adiciona">
	<div class="ui-corner-all custom-corners">
		<div class="ui-bar ui-bar-a" style="text-align:center;">
			<b class="prdcod"><a href="" data-ajax="false">' . $barras . '</a></b>
			
			<input name="codigo" type="hidden" value="' . $barras . '">
			<br>
			<b class="prddesc">' . $descricao . '</b>					
			<input name="produto" type="hidden" value="' . $descricao . '">
			<input name="complemento" type="hidden" value="' . $complemento . '">
			<input name="ncm" type="hidden" value="' . $ncm . '">
			<input name="codmdlog" type="hidden" value="' . $codmdlog . '">
			<input name="estloja10" type="hidden" value="' . $estloja10 . '">
			<input name="estloja20" type="hidden" value="' . $estloja20 . '">
			<input name="estloja30" type="hidden" value="' . $estloja30 . '">
			<br>
			';
						$preco = str_replace('.', ',', $preco);
						$pr_antigo = str_replace('.', ',', $pr_antigo);
						echo '
			<b class="prdval_antigo" >R$ ' . $pr_antigo . '</b>
			<br>
			<b class="prdval">R$ ' . $preco . '</b>
			<input name="valor" type="hidden" value="' . $preco . '">
			<input name="d" type="hidden" value="1">
			<div class="" style="margin:auto;">
			<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style=" width:40px;    background-color: black;
color: white;
font-size: 14px;
margin: 0;" id ="menos">-</button>



			<div style="text-align:center;    width: 100px;
display: inline-table;">
			<input name="qtd" id="qtd" class="" style="text-align:center;    width: 100px;
display: inline-table;" type="text" maxlength=3  id="menos" size="10" value="1">
</div>
			<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style="width:40px;    background-color: black;
color: white;
font-size: 14px;
margin: 0;" id="mais">+</button>
			
			</div>
			</div>
	<div class="ui-corner-all custom-corners">';
						echo '
		</div>
		<div class="confirma" style="text-align:center">
			<a href="#" onclick="adiciona.submit();" data-ajax="false" style="background-color:green;color:white;font-weight: normal;" class="ui-btn ui-btn-inline ">ADICIONAR A IMPRESSAO</a>
			';
						echo '			
			
				<script type="text/javascript">
				
				
			$(document).keypress(function(e) {
				//$("#qtd").focus();
				if(e.which == 13) {
					//$("#adiciona").submit();
			
				}
				
			});
			document.onkeydown = function(evt) {
evt = evt || window.event;
var isEscape = false;
if ("key" in evt) {
isEscape = (evt.key == "Escape" || evt.key == "Esc");
} else {
isEscape = (evt.keyCode == 27);
}
if (isEscape) {
location.href = "index.php";
}
};




			</script>
			
			
		</div>
	</div>
	
	</form>';
					} else {

						echo '
	<form action="impressao_add.php" method="get" id="adiciona">
	<div class="ui-corner-all custom-corners">
		<div class="ui-bar ui-bar-a" style="text-align:center;">
			<b class="prdcod"><a href="" data-ajax="false">' . $barras . '</a></b>
			
			<input name="codigo" type="hidden" value="' . $barras . '">
			<br>
			<b class="prddesc">' . $descricao . '</b>					
			<input name="produto" type="hidden" value="' . $descricao . '">
			<input name="complemento" type="hidden" value="' . $complemento . '">
			<input name="ncm" type="hidden" value="' . $ncm . '">
			<input name="codmdlog" type="hidden" value="' . $codmdlog . '">
			<input name="estloja10" type="hidden" value="' . $estloja10 . '">
			<input name="estloja20" type="hidden" value="' . $estloja20 . '">
			<input name="estloja30" type="hidden" value="' . $estloja30 . '">
			<br>
			';
						$preco = str_replace('.', ',', $preco);
						echo '			
			<b class="prdval">R$ ' . $preco . '</b>
			<input name="valor" type="hidden" value="' . $preco . '">
			<input name="d" type="hidden" value="1">
			<div class="" style="margin:auto;">
			<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style=" width:40px;    background-color: black;
color: white;
font-size: 14px;
margin: 0;" id ="menos">-</button>



			<div style="text-align:center;    width: 100px;
display: inline-table;">
			<input name="qtd" id="qtd" class="" style="text-align:center;    width: 100px;
display: inline-table;" type="text" maxlength=3  id="menos" size="10" value="1">
</div>
			<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style="width:40px;    background-color: black;
color: white;
font-size: 14px;
margin: 0;" id="mais">+</button>
			
			</div>
			</div>
	<div class="ui-corner-all custom-corners">';
						echo '
		</div>
		<div class="confirma" style="text-align:center">
			<a href="#" onclick="adiciona.submit();" data-ajax="false" style="background-color:green;color:white;font-weight: normal;" class="ui-btn ui-btn-inline ">ADICIONAR A IMPRESSAO</a>
			';
						echo '			
			
				<script type="text/javascript">
				
				
			$(document).keypress(function(e) {
				//$("#qtd").focus();
				if(e.which == 13) {
					//$("#adiciona").submit();
			
				}
				
			});
			document.onkeydown = function(evt) {
evt = evt || window.event;
var isEscape = false;
if ("key" in evt) {
isEscape = (evt.key == "Escape" || evt.key == "Esc");
} else {
isEscape = (evt.keyCode == 27);
}
if (isEscape) {
location.href = "index.php";
}
};




			</script>
			
			
		</div>
	</div>
	
	</form>';
					}


					echo '<style>#formprin,#listaimpressao,#cabimprime{}</style>';
					$encontrado = 1;

					if ($_SESSION['auto'] == 1) {
						echo '<style>#formprin,#listaimpressao,#cabimprime,.confirma,#conftxt	{}</style>';


						/*echo '<script>$( "#adiciona" ).submit();</script>';*/

						//$novo = 
						if (isset($_GET["n"]) && $_GET["n"] == 1) {
							$tempo = 0;
						} else {
							$tempo = 2500;
						}

						echo '<script>window.setTimeout(function () {
					$( "#adiciona" ).submit();
					}, ' . $tempo . ');</script>';
					}
				}



				echo "</div>";

				if ($encontrado == 0) {
					echo '<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a" style="text-align:center; color:red;">Produto não encontrado!</div>
			</div>';
				}
			}
		}
		?>
    <div data-role="header" data-theme="a" id="cabimprime" style="font-size:12px">


    </div>


    <table data-role="table" id="listaimpressao" data-mode="" class="ui-body-d ui-shadow table-stripe ui-responsive"
        style="font-size:14px" data-column-btn-theme="b" data-column-btn-text="Columns to display..."
        data-column-popup-theme="a">
        <tr>
            <!--<td class="tabtitulo"></td>-->
            <td class="tabtitulo"><strong>Codigo</strong></td>
            <td class="tabtitulo"><strong>Produto</strong></td>
            <td class="tabtitulo"><strong>Qtd</strong></td>
            <td class="tabtitulo"><strong>Valor</strong></td>
            <td class="tabtitulo"></td>
            <td class="tabtitulo"></td>
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
            <!--<td width="23"><b><?php echo $ordem; ?></b></td>-->
            <td><?php echo $linhaimp['codigo']; ?></td>
            <td><?php echo $linhaimp['des']; ?></br><span style="font-size: 8px;">ESTOQUE 10:
                    <b><?php echo $linhaimp['estloja10']; ?></b> 20: <b><?php echo $linhaimp['estloja20']; ?></b> 30:
                    <b><?php echo $linhaimp['estloja30']; ?></b></span></td>

            <td><?php echo $linhaimp['qtd']; ?></td>
            <td>R$ <?php echo $linhaimp['valor']; ?></td>

            <td id="soma"><a
                    href="impressao_add.php?codigo=<?php echo $linhaimp['codigo']; ?>&produto=<?php echo $linhaimp['produto']; ?>&qtd=<?php echo "1"; ?>&valor=<?php echo $linhaimp['valor']; ?>&d=1"
                    class="prdexcluir" alt="Exclur">+</a></td>

            <td id="soma"><a href="impressao_remove.php?id=<?php echo $linhaimp['codigo']; ?>" class="prdduplicar"
                    alt="Duplcar">X</a></td>


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
    </div>

    <?php
		if ($_GET["novo"] == 1) {
			echo '<script> $(document).one("pageshow", "#home", [], function () {

                        $(document).off("pageshow", "#home");
                        var fn = function () {
                            $("#openDialog").trigger("click");
                        }
                        var _tmr = setTimeout(fn, 100);
            
        });</script>';
			echo "aaaa";
		}

		?>

    <script>
    $(document).ready(function() {
        $('#menos').click(function() {
            var x = document.getElementById('qtd').value || 0;
            var myResult = parseInt(x) + -1;


            if (myResult > 0) {
                $("#qtd").val(myResult);
            }

        });


        $('#mais').click(function() {
            var x = document.getElementById('qtd').value;
            var myResult = parseInt(x) + 1;
            $("#qtd").val(myResult);



        });
        $("#codigo").focus();

    });
    </script>


    </div>

    <!--<table width="" style="color: red;
    font-size: 10px;
    margin: auto;" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <td>16/07/2018</td>
    <td>ADICIONADOS BOTAO DE MAIS E MENOS E AUMENTADO O PARA 999</td>
  </tr>
  <tr>
    <td>05/06/2018</td>
    <td>ADICONADO MOD AUTOMATICO COM SUPORTE A IOS</td>
  </tr>
  <tr>
    <td>05/06/2018</td>
    <td>ADICIONADO MODO ALTEAÇÃO DE PREÇOS</td>
  </tr>
  <tr>
    <td>05/06/2018</td>
    <td>ADICIONADA INFORMATIVO DE ALTERACAO DE PRECOS DE PRODUTOS</td>
  </tr>
</table>
-->


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

</body>

</html>
<?php } else {
	header("Location: entrar.php");
}
?>