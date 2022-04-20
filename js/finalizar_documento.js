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
        var itens = $("input[name='itens']:checked").val();
        var documento = $('#documento').val();

        // Método post do Jquery
        $.post('painel_finalizar.php', {
            itens: itens,
            documento: documento
        }, function(resposta) { // Valida a resposta

            if (resposta == 1) {
                // Limpa os inputs
                itens = '';
                documento = '';

                alert('Separação finalizada com sucesso.');
                history.go(0);

            } else {
                itens = '';
                documento = '';

                alert(resposta);
                history.go(0);

            }
        }).done(function() {
            setTimeout(function() {
                $("#overlay").fadeOut(300);
            }, 500);
        });;

    });
});