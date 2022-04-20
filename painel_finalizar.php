<?php
$id_atendimento = $_POST['documento'];
$itens_atendidos = $_POST['itens'];

atAtendimento($id_atendimento, $itens_atendidos);


function atAtendimento($id_atendimento, $itens_atendidos)
{
    include('sql_update_atendimentos.php');
}