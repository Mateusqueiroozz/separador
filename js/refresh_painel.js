$(document).ready(function() {
    refreshTable();
});

function refreshTable() {
    $('#data').load('sql_consulta_atendimentos.php', function() {
        setTimeout(refreshTable, 120000);
    });
}