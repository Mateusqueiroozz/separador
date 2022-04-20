<?php
session_start();
$loja = $_SESSION['loja'];
$endereco = "localhost";
$usuario = "root";
$senha = "";
$banco = "reposicao";

$link = mysqli_connect($endereco, $usuario, $senha, $banco);
$sql = "SELECT at.cod_documento, at.inicio_separacao, case when at.situacao = 'A' then 'Em separação' when at.situacao = 'B' then 'Separação finalizada' end as situacao, case when at.tipo_atendimento = 'reposicao' then 'Reposição' when at.tipo_atendimento = 'venda' then 'Venda' end as tipo_atendimento, CONCAT(atendentes.codigo,' - ', atendentes.nome) as nome, at.qtd_itens as qtd_itens FROM atendimentos at left join atendentes on (at.id_atendente = atendentes.id) WHERE at.loja = '$loja' and inicio_separacao BETWEEN CURRENT_DATE and NOW()";

$resultado = mysqli_query($link, $sql);
while ($linha = mysqli_fetch_array($resultado)) {

?>



<tr data-widget="expandable-table" aria-expanded="false">
    <td><?php echo $linha['nome'] ?></td>
    <td><?php echo $linha['cod_documento'] ?></td>
    <td><?php echo $linha['qtd_itens'] ?></td>
    <td><?php echo $linha['tipo_atendimento'] ?></td>
    <td><?php echo $linha['inicio_separacao'] ?></td>
    <td><?php echo $linha['situacao'] ?></td>

</tr>
<tr class="expandable-body d-none">
    <td colspan="5">
        <p>
            informações dos produtos da separação
        </p>
    </td>
</tr>

<?php } ?>