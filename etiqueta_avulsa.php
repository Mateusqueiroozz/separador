<?php
session_start();


$sessao = session_id();
$impressora = $_SESSION['impressora'];
$avulsa = 1;

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
	$consultaimp= mysqli_query($link, "SELECT * FROM impressora WHERE id='".$impressora."'");
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

<div data-role="header" class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset">
<h2>Busca Preço - Etiqueta avulsa </h2>
<form action="impressao_add.php" method="get" id="formprin" data-ajax="false"class="needs-validation">
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">CODIGO:</label>
      <input type="text" class="form-control" id="codigo" name="codigo" placeholder="" value="" required>
      
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">DESCRICAO DO PRODUTO:</label>
      <input type="text" class="form-control" id="produto" name="produto" placeholder="" value="" required>
      
    </div>
    <div class="col-md-4 mb-3">
      <label for="CustomUsername">VALOR:</label>
      <div class="input-group">        
        <input type="text" class="form-control" id="valor" placeholder="" name="valor" aria-describedby="inputGroupPrepend">
      </div>
    </div>
	<div class="col-md-4 mb-3">
      <label for="validationCustomUsername">QUANTIDADE:</label>
      <div class="input-group">        
        <input type="text" class="form-control" id="qtd" placeholder="" name="qtd" aria-describedby="inputGroupPrepend" required>
      </div>
    </div>
  </div>
  
  <div  class="pesquisar">
  <input type="submit" value="Enviar" data-icon="" data-theme="b">
  </div>
</form>

<script>
// Exemplo de JavaScript inicial para desativar envios de formulário, se houver campos inválidos.
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Pega todos os formulários que nós queremos aplicar estilos de validação Bootstrap personalizados.
    var forms = document.getElementsByClassName('needs-validation');
    // Faz um loop neles e evita o envio
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
</body>
</html>