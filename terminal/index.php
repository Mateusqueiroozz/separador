<?php

include('../conexao.php');

function extenso($valor = 0, $maiusculas = false) {

$singular = array("centavo", "real", "mil", "milhão", "bilhão", "trilhão", "quatrilhão");
$plural = array("centavos", "reais", "mil", "milhões", "bilhões", "trilhões",
"quatrilhões");

$c = array("", "cem", "duzentos", "trezentos", "quatrocentos",
"quinhentos", "seiscentos", "setecentos", "oitocentos", "novecentos");
$d = array("", "dez", "vinte", "trinta", "quarenta", "cinquenta",
"sessenta", "setenta", "oitenta", "noventa");
$d10 = array("dez", "onze", "doze", "treze", "quatorze", "quinze",
"dezesseis", "dezesete", "dezoito", "dezenove");
$u = array("", "um", "dois", "três", "quatro", "cinco", "seis",
"sete", "oito", "nove");

$z = 0;
$rt = "";

$valor = number_format($valor, 2, ".", ".");
$inteiro = explode(".", $valor);
for($i=0;$i<count($inteiro);$i++)
for($ii=strlen($inteiro[$i]);$ii<3;$ii++)
$inteiro[$i] = "0".$inteiro[$i];

$fim = count($inteiro) - ($inteiro[count($inteiro)-1] > 0 ? 1 : 2);
for ($i=0;$i<count($inteiro);$i++) {
$valor = $inteiro[$i];
$rc = (($valor > 100) && ($valor < 200)) ? "cento" : $c[$valor[0]];
$rd = ($valor[1] < 2) ? "" : $d[$valor[1]];
$ru = ($valor > 0) ? (($valor[1] == 1) ? $d10[$valor[2]] : $u[$valor[2]]) : "";

$r = $rc.(($rc && ($rd || $ru)) ? " e " : "").$rd.(($rd &&
$ru) ? " e " : "").$ru;
$t = count($inteiro)-1-$i;
$r .= $r ? " ".($valor > 1 ? $plural[$t] : $singular[$t]) : "";
if ($valor == "000")$z++; elseif ($z > 0) $z--;
if (($t==1) && ($z>0) && ($inteiro[0] > 0)) $r .= (($z>1) ? " de " : "").$plural[$t];
if ($r) $rt = $rt . ((($i > 0) && ($i <= $fim) &&
($inteiro[0] > 0) && ($z < 1)) ? ( ($i < $fim) ? ", " : " e ") : " ") . $r;
}

if(!$maiusculas){
return($rt ? $rt : "zero");
} else {

if ($rt) $rt=ereg_replace(" E "," e ",ucwords($rt));
return (($rt) ? ($rt) : "Zero");
}

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<!--<meta http-equiv="refresh" content="10">-->
<title>CONSULTA DE PRE&Ccedil;O</title>
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="expires" content="timestamp">
<script language="javascript" type="text/javascript" src="index.js"></script>
  <script language="javascript" type="text/javascript" src="/jquery.js"></script>
<style type="text/css">
body {
background-color:red;
font-family:sans-serif;
overflow-y: hidden
}
body,div,form,.campo {
margin:0;
padding:0;
border:0
}
*:focus {outline: none;}
.cabeca, .barra {
background-color:red; 
color:white;
text-align:center
}
.resultado,#busca,.botao,.campo {
background-color:yellow
}
#busca,.botao {
color:yellow;border:0
}
.campo {
margin-left:5px;
overflow: hidden;
font-weight:bold;
font-size:15px;
font-family:monospace;
color:#000000;
text-transform:uppercase
}
h1 {
font-size: 40px
}
h5 {
font-size: 20px
}
h6 {
font-size: 17px
}
.resultado{
	min-height:200px;
	text-align:center;
	
}
</style>
</head>
<body onload="document.getElementById('codigo').focus();">
<div style="">
<form action="index.php">
  <input name="codigo" id="codigo" autocomplete="off" type="text">
  <input name="enviar" type="submit">
</form>
</div>
<div class="cabeca">

<div style="font-size:90px; margin-top:5px;">BUSCA PRE&Ccedil;O</div>
<div style="font-size:24px; margin-bottom:3px;">PASSE O C&Oacute;DIGO DE BARRAS DO PRODUTO SOB O FEIXE DE LUZ</div>
</div>

<div class="resultado">
<?php


//if($_GET[codigo]>0){
	$consulta = mysql_query("SELECT codigo,produto,max(valor) as valor,estoque FROM produto WHERE trim(codigo)='".$_GET[codigo]."'");
//	echo "SELECT codigo,produto,max(valor) as valor,estoque FROM produto WHERE trim(codigo)='".$codigo."''";
			$linha = mysql_fetch_array($consulta);
			
			
			//echo "aaa";
			//se somente um produto
			if($linha['codigo']>0){
	
?>
<span style="font-size:35px;"> <?php echo $linha['codigo']?></span><br>
<span style="font-size:40px;"><?php echo $linha['produto']?></span><br>
<span style="font-size:90px; font-weight:bold;">R$ <?php echo $linha['valor']?></span>

  <!--<script src="speakClient.js"></script>

   <script src='/js/responsivevoice.js'></script>
   -->
    <div id="audio"></div>
    <?php
	//recurso de fala
	// so falta falar em portugues
	$valor = $linha['valor'];
 $dim = extenso($valor);
$dim = ereg_replace(" E "," e ",ucwords($dim));

$valor = number_format($valor, 2, ",", ".");

//echo "R$ $valor$dim";
	?>
  
  
   <!--<input id="foo" style="display:none;" onclick='responsiveVoice.speak("<?php echo $row->NOMEPROD." ".$dim;?>","Brazilian Portuguese Female");' type='button' value=' Play' />
  <input id="foo" style="display:none;" onclick='responsiveVoice.speak("bom dia xuxa","Brazilian Portuguese Female");' type='button' value=' Play' />-->
  <?php // echo utf8_encode($dim);?>
    <input id="foo" style="display:none;" onclick='responsiveVoice.speak("<?php echo utf8_encode("Irene Raphaella Machado Fonseca");?>","Brazilian Portuguese Female");' type='button' value=' Play' />
    <script>
	
	//setTimeout(function() {
  //  alert("Hii");
   // $("#foo").trigger('click');  
//}, 500);
setTimeout(function () {
   window.location.href = "index.php"; //will redirect to your blog page (an ex: blog.html)
}, 1000); 


</script>
  

<?php
		
			}else{
				if($_GET["codigo"]>0){
			?>
         <br>      <br>   
<span style="font-size:50px;">PRODUTO NAO ENCOTRADO!<br>
 CONSULTE UM FUNCIONARIO.</span><br>
<span style="font-size:90px; font-weight:bold;"></span>
  <script>
setTimeout(function () {
   window.location.href = "index.php"; //will redirect to your blog page (an ex: blog.html)
}, 800); 
</script>
            <?php
				}
				?>
             
                <?php
				
			}
//}
?>
</div>
<div class="barra"> 
<div style="font-size:24px; margin-bottom:10px; margin-top:3px;">AGUARDE A CONSULTA ANTERIOR APAGAR ANTES DE REALIZAR OUTRA</div>
<img src="barcode.gif" width="220"><br><br>


</div>
</body>
</html>