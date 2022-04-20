<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$sessao = session_id();
$impressora = $_SESSION['impressora'];


$ok = $_GET['ok'];

if($ok == 1){
	$_SESSION['precos'] = 1;

	include('conexaoPDO.php');
}

$tipo = $_SESSION['tipo'];

if($tipo == ""){
	$_SESSION['tipo'] = "GONDOLA";

}

if($impressora == ""){
	
	echo '<script> location.href = "impressora.php";</script>';

}

if($tipo == ""){
	$tipo = "GONDOLA";
	
}
if($tipo == "GONDOLA"){
	$tipoimpressao = 'Impressão padrão';
}

if($tipo == "ETIQUETA"){
	$tipoimpressao =  'Produto individual';
}



include('conexao.php');

//impressora
	$consultaimp= mysqli_query($link,"SELECT * FROM impressora WHERE id='".$impressora."'");
	$linhaimp = mysqli_fetch_array($consultaimp);
	
	$nomeimpressora = $linhaimp['descricao'];
//echo $nomeimpressora;


?>


<!DOCTYPE html>
<html> 
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title> Busca Preço</title> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.css" />
	<script src="/buscapreco/js/jquery.js"></script>
	<script src="/buscapreco/js/jquery.mobile/jquery.mobile-1.4.5.min.js"></script>
    
    <style>
	.depur{
		background-color:#FFF;
		color:red;
		padding:5px;
		margin:10px;
		border:1px solid red;
		display:none;
		
	}
	
	.pesquisar div {
	margin: 1px;
    padding: 6px;
    background-color: red !important;
    color: white !important;
    font-weight: normal !important;
	}
	
	.prdcod{
	    font-size: 28px;
    	color: gray;
	}
	.prddesc{
		font-size: 22px;
		color: green;
	}
	.prdval{
	    font-size: 30px;
    	color: red;
}

.prdexcluir{
	
color: green !important;
    text-decoration: none;
    font-weight: normal;	
}
.prdduplicar{
	
color: red !important;
    text-decoration: none;
    font-weight: normal;	
}
.confirma{
	font-weight:normal;
	
}
.ui-table th, .ui-table td{
	line-height: 12px;
}
.tabtitulo{
	font-size:12px;
	
	
}
	
	
#cabimprime a {
    height: 23px !important;
    margin: 0 !important;
    line-height: 25px !important;
    padding: 0 5px 0px 6px !important;
}
	
div.ui-slider-switch.ui-mini{
	
		width: 50px;
    position: absolute;
    top: 74px;
    right: 15px;
	
}
	.ui-bar{
		padding:0 !important;
		
		
	}
	a {text-decoration:none !important; color:#fff }
	
	not:input{width:100px;}
	.adiciona .ui-input-text{
		width:100px !important;
	
	
	}	
	
	.tGONDOLA{
		
	/*background-color: blue !important
*/		
	}
	.tETIQUETA{
		
	background-color: red !important
		
	}
	
	
	.valor_anterior{
		
		text-decoration:underline;
		color:red;
		font-size:14px;
		
	}
	</style>
    
<script>




function contador() {
	var str = $("#codigo").val();
   // var str = "Hello World!";
    var n = str.length;
   // document.getElementById("demo").innerHTML = n;
	
	
	if(n > 12){
		//alert(n);
		$( "#formprin" ).submit();
		}
	
	
}

</script>
</head> 
<body> 

<div data-role="header" data-theme="b">
<h2>Busca Preço </h2>

<div class="btn-group pull-right" style="position: absolute;top: 0; right: 0">

            <a href="impressora_tipo.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right t<?php echo  $_SESSION['tipo'];?>"><?php echo ($tipoimpressao);?></a>
            
            <a href="impressora.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right ui-btn-icon-right ui-icon-carat-r"><?php echo utf8_encode($nomeimpressora);?></a>
            
         
        </div>
	<a href="etiqueta_avulsa.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ui-btn-icon-left" data-ajax="false">Gerar Etiqueta Avulsa</a>
	
    
</div>


<div style="padding:10px;">

<form action="index.php" method="get" id="formprin" data-ajax="false">


<label for="text-basic" style="text-align:center; font-size:12px; ">Digite ou use o leitor para buscar produtos:</label>
<input type="number" style="text-align:center" name="codigo" id="codigo"  autocomplete="off" onDblClick="this.value = ''" value="<?php //echo $_GET['codigo'];?>" autofocus>
<input name="n" value="<?php echo $_GET['n'];?>" type="hidden"text">

<select onChange="location.href = 'impressao_auto.php'" name="slider-flip-m" id="slider-flip-m" data-role="slider" data-mini="true" title="Automatico ou manual">
<?php
if($_SESSION['auto']==1){
	
	echo '<option value="off">M</option>
	<option value="on" selected="">A</option>';
	
}else{
echo '<option value="off"  selected="">M</option>
	<option value="on">A</option>';
}

?>
</select>
<div  class="pesquisar">
<input type="submit" value="Pesquisar" data-icon="" data-theme="a">

</div>
</form>

<form action="#" method="get">
            Código de barras
            <a href="http://zxing.appspot.com/scan?ret=http://192.168.254.231/buscapreco/index.php?codigo={CODE}&n=&slider-flip-m=on">Leitor</a>:
        </form>
	
<?php



$codigo = $_GET['codigo'];

//echo $codigo;



if($codigo > 0){
	
if($_GET["n"] == 1){
	
}else{
	
	
	
echo "<div class='sim'>";	


	$consultaprd = mysqli_query($link,"SELECT * FROM produto WHERE(codigo1='".$codigo."' OR codigo2='".$codigo."') ORDER BY valor DESC LIMIT 1");
	
	
	while ($linhaprd = mysqli_fetch_array($consultaprd)){
		//echo '<br>';
		echo '
			<form action="impressao_add.php" method="get" id="adiciona">
			<div class="ui-corner-all custom-corners">
				<div class="ui-bar ui-bar-a" style="text-align:center;">
					<b class="prdcod"><a href="index.php?codigo='.$codigo.'" data-ajax="false">'.$codigo.'</a></b>
					
					<input name="codigo" type="hidden" value="'.$codigo.'">
					<br>
					<b class="prddesc">'.$linhaprd['produto'].'</b>
					<b class="prddesc">'.$linhaprd['complemento'].'</b>
					<input name="produto" type="hidden" value="'.$linhaprd['produto'].'">
					<input name="complemento" type="hidden" value="'.$linhaprd['complemento'].'">
					<br>
					
					
					
					';
					
					//$consultaprdant = mysqli_query($link, "SELECT
					//							impressao.id,
						//						impressao.sessao,
							//					impressao.id_impressora,
								//				max(impressao.data_hora),
									//			impressao.codigo,
										//		impressao.tipo,
											//	impressao.produto,
												//impressao.complemento,
											//	impressao.valor,
												//impressao.id_situacao
												
											//	FROM `impressao`
												//WHERE `codigo` = '".$codigo."' and id_impressora = ". $_SESSION['impressora']." and id_situacao=0");

												
												


					//$linhaprdant = mysqli_fetch_array($consultaprdant);
					// if($linhaprdant['valor'] != $linhaprd['valor'] && $linhaprdant['valor']>0 ){
						 
					//	 echo '<div class="valor_anterior">Valor anterior R$'. $linhaprdant['valor'].'</div>';
					// }
					
					
						
					echo '
					<b class="prdval">R$ '.$linhaprd['valor'].'</b>
					<input name="valor" type="hidden" value="'.$linhaprd['valor'].'">
					<input name="d" type="hidden" value="1">
					<div class="" style="margin:auto;">
					<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style=" width:40px;    background-color: red;
    color: white;
    font-size: 14px;
    margin: 0;" id ="menos">-</button>
	
	
	
					<div style="text-align:center;    width: 100px;
    display: inline-table;">
					<input name="qtd" id="qtd" class="" style="text-align:center;    width: 100px;
    display: inline-table;" type="text" maxlength=3  id="menos" size="10" value="1">
	</div>
					<button type="button"  data-ajax="false" class="ui-btn ui-btn-inline ui-corner-all ui-mini" style="width:40px;    background-color: green;
    color: white;
    font-size: 14px;
    margin: 0;" id="mais">+</button>
					
					</div>
					</div>
			<div class="ui-corner-all custom-corners">';
				//echo '		<div class="ui-bar ui-bar-a" style="text-align:center; color:red;"><b id="conftxt">Deseja adicionar a impressão?</b></div>';
				
				echo '
				</div>
				<div class="confirma" style="text-align:center">
					<a href="#" onclick="adiciona.submit();" data-ajax="false" style="background-color:green;color:white;font-weight: normal;" class="ui-btn ui-btn-inline ui-icon-check ui-btn-icon-left">adicionar a impressão</a>
					';
					//echo '<a href="index.php" data-ajax="false" style="background-color:red;color:white;font-weight: normal;" class="ui-btn ui-btn-inline ui-icon-delete ui-btn-icon-right">Não</a>';
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
			
		echo '<style>#formprin,#listaimpressao,#cabimprime{}</style>';
	$encontrado =1;
	
		if($_SESSION['auto']==1){
			echo '<style>#formprin,#listaimpressao,#cabimprime,.confirma,#conftxt	{}</style>';
			
			
			/*echo '<script>$( "#adiciona" ).submit();</script>';*/
			
			//$novo = 
					if(isset($_GET["n"]) && $_GET["n"]==1) {
						$tempo == 0;
					}else{
						$tempo == 1000;
					}
						
					echo '<script>window.setTimeout(function () {
					$( "#adiciona" ).submit();
					}, '.$tempo .');</script>';
					
		}
		

	}
echo "</div>";	
	
	if($encontrado == 0){
		echo '<div class="ui-corner-all custom-corners">
			<div class="ui-bar ui-bar-a" style="text-align:center; color:red;">Produto não encontrado!</div>
			</div>';	
		
		
	}
	
}

}
?>
<div data-role="header" data-theme="a" id="cabimprime" style="font-size:12px">
<h2>Lista de Impressão</h2>
	<a href="#popupDialog" id="limpar" data-rel="popup" data-position-to="window" data-transition="pop" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-left ">LIMPAR</a>
	<a href="impressao_imprimir.php" class="ui-btn ui-corner-all ui-btn-inline ui-mini footer-button-right " data-ajax="false">IMPRIMIR</a>
</div>


<table data-role="table" id="listaimpressao" data-mode="" class="ui-body-d ui-shadow table-stripe ui-responsive" style="font-size:14px" data-column-btn-theme="b" data-column-btn-text="Columns to display..." data-column-popup-theme="a">
<tr>
<td class="tabtitulo"></td>
	<td class="tabtitulo"><strong>Codigo</strong></td>
    <td class="tabtitulo"><strong>Produto</strong></td>
	<td class="tabtitulo"><strong>Complemento</strong></td>
    <td class="tabtitulo"><strong>Qtd</strong></td>
    <td class="tabtitulo"><strong>Valor</strong></td>
    <td class="tabtitulo"></td>
    <td class="tabtitulo"></td>
</tr>
           
         


  <?php
	$ordem = 0;
	$consultaimp = mysqli_query($link,"
	SELECT
impressao.data_hora,
impressao.tipo,
impressao.codigo,
impressao.produto,
impressao.complemento,
impressao.valor,
impressao.id_situacao,
Sum(impressao.qtd) as qtd
FROM
impressao
WHERE
impressao.id_situacao = 1 and sessao='".$sessao."'

GROUP BY 
impressao.codigo

ORDER BY id desc");


	while ($linhaimp = mysqli_fetch_array($consultaimp)){
		$ordem ++;
	?>
    
<tr>
 	<td width="23"><b><?php echo $ordem;?></b></td>
    <td><?php echo $linhaimp['codigo'];?></td>
    <td><?php echo $linhaimp['produto'];?></td>
	<td><?php echo $linhaimp['complemento'];?></td>
    <td><?php echo $linhaimp['qtd'];?></td>
    <td>R$ <?php echo $linhaimp['valor'];?></td>
    <td><a href="impressao_add.php?codigo=<?php echo $linhaimp['codigo'];?>&produto=<?php echo $linhaimp['produto'];?>&qtd=<?php echo "1";?>&valor=<?php echo $linhaimp['valor'];?>&d=1" class="prdexcluir" alt="Exclur">+</a></td>
  
    <td><a href="impressao_remove.php?id=<?php echo $linhaimp['codigo'];?>" class="prdduplicar" alt="Duplcar">X</a></td>
    
    </tr>
	<?php
	
	}
	
	?>
</table>

<br>
<div data-role="popup" id="popupDialog" data-overlay-theme="a" data-theme="b" data-dismissible="false" style="max-width:400px;">
<div data-role="header" data-theme="a">
<h1 style="margin:0">Limpar lista de impressão?</h1>
</div>
<div role="main" class="ui-content" style="text-align:center">
<h3 class="ui-title">Tem certeza que deseja apagar tudo?</h3>
<p style="display:none">This action cannot be undone.</p>
<a href="index.php" style="background-color: green;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-rel="back">Não</a>
<a href="impressao_limpar.php"  style="background-color: red;" class="ui-btn ui-corner-all ui-shadow ui-btn-inline ui-btn-b" data-ajax="false" data-rel="" data-transition="flow">Sim</a>
</div>
</div>

<?php
if($_GET["novo"]==1){
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

<script> $(document).ready( function () {
$('#menos').click(function() {
     var x = document.getElementById('qtd').value || 0;
  var myResult = parseInt(x) +-1;
  
  
  if(myResult>0){
  $("#qtd").val(myResult);
  }
   
});


$('#mais').click(function() {
  var x = document.getElementById('qtd').value;
  var myResult = parseInt(x) +1;
   $("#qtd").val(myResult);
  


});
                      $("#codigo").focus();
                     
        });</script>
		
		
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
</body>
</html>