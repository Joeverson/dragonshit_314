<script type="text/javascript">
    $(function(){
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
    });
</script>
</body>
</html>