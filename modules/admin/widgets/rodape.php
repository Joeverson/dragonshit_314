<script type="text/javascript">

    //var $j = jQuery.noConflict();
    // Use jQuery com a variavel $j para evitar conflitos
    $(document).ready(function(){
        $(".mask-data").mask("99/99/9999"); // onde #data é o id do campo
        $(".mask-cep").mask("99.999-999"); // onde #cep é o id do campo
        $(".mask-cpf").mask("999.999.999-99"); // onde #cpf é o id do campo
        $(".mask-cnpj").mask("99.999.999/9999-99"); // onde #cnpj é o id do campo
        $(".mask-tel").mask("(99) 9999-9999"); // onde #telefone é o id do campo
    });
    //tooltip
    $(function() {
        $('.tool').tooltip({
            show: { effect: "fadeIn", duration: 500 }
        });
    });
</script>
</body>
</html>
