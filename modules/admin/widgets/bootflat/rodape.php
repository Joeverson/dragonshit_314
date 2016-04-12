</div>

</div>
<!-- /#wrapper -->
<!-- div de notificações -->
<div class="alert alert-success alert-dismissable notification">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <strong></strong>.
</div>
<!-- /div de notificações -->



<!-- Modal -->
<div class="modal fade modalUsers" id="modalUsers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">...</h4>
            </div>
            <form id="formEditUser">
                <!--body-->
                <div class="modal-body"></div>
                <!--/body-->

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Fechar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-hdd-o"></i> Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function () {


        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;


        trigger.click(function () {
            hamburger_cross();
        });

        // responsavel por carregar na pagina as pages...
        $('a').click(function(){
            //ajaxUrl($(this).data('link'));
        });



        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });


    $(function(){
        // ajax of actions

        $(".fn").on("click", function(){
            var url = $(this).data('url');
            var title = $(this).data('title');
            var id = $(this).data('id');


            $.ajax({
                url: '<?=$endereco?>'+url,
                type: 'post',
                data: "id="+id,
                datatype: 'html',
                beforeSend: function(){
                    //$('.progress-bar').show();
                },
                complete: function() {
                    //$('.progress-bar').fadeOut();
                },
                success: function(e){
                    $('.modal-title').html(title);
                    $('.modal-body').html(e);
                    $('#modalUses').modal('show');
                }
            });
        });
    });

    $("#formEditUser").on("submit",function(){
        event.preventDefault();
        var url = $(".editForm").data('url');

        if($(".editForm").data('url') != null)
            url = '<?=$endereco?>'+$(".editForm").data('url');
        else if($(".urlTrasiction").data('url') != null)
            url = $(".urlTrasiction").data('url');

        $.ajax({
            url: url,
            type: 'post',
            data:  new FormData(this),
            datatype: 'html',
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function(){
                $('.progress-bar').show();
            },
            complete: function() {
                $('.progress-bar').fadeOut();
            },
            success: function(e){
                window.location.reload();
                //console.log(e);

            }
        });
    });

</script>
<script>tinymce.init({selector:'.textEdit'});</script>
</body>
</html>