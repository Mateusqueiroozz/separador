$(function() {

    /* 
        jQuery(function($) {
            $(document).ajaxSend(function() {
                $("#overlay").fadeIn(300);　
            });

            $('#button').click(function() {
                $.ajax({
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                    }
                }).done(function() {
                    setTimeout(function() {
                        $("#overlay").fadeOut(300);
                    }, 500);
                });
            });
        }); */

    // Executa assim que o botão de salvar for clicado
    $('#form_documento').submit(function(e) {
        $(document).ajaxSend(function() {
            $("#overlay").fadeIn(300);　
        });

        // Cancela o envio do formulário
        e.preventDefault();

        // Pega os valores dos inputs e coloca nas variáveis        
        var tipo_documento = $("input[name='tipo_documento']:checked").val();
        var impressao = "";
        var impressora = $("[name=impressora]").val();
        var documento = $("[name=documento]").val();
        var atendente = $("[name=atendente]").val();
        var impressao = $("input[name='impressao']:checked").val();
        var tipo_atendimento = $("input[name='tipo_atendimento']:checked").val();

        // Método post do Jquery
        $.post('painel_impressao.php', {
            tipo_atendimento: tipo_atendimento,
            tipo_documento: tipo_documento,
            impressao: impressao,
            impressora: impressora,
            documento: documento,
            atendente: atendente
        }, function(resposta) { // Valida a resposta

            if (resposta == 1) {
                // Limpa os inputs
                tipo_atendimento = '';
                tipo_documento = '';

                alert('Separação iniciada com sucesso.');

            } else {
                tipo_atendimento = '';
                tipo_documento = '';

                alert(resposta);

            }
        }).done(function() {
            setTimeout(function() {
                $("#overlay").fadeOut(300);
            }, 500);
        });;

    });
});