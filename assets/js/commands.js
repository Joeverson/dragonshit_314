var commands = [
    {
        term: 'version',
        category: 'info',
        action: function(){alert('CPC - 0.1Beta');}
    },
    {
        term: 'owner',
        category: 'info',
        action: function(){alert('Joerverson Santos \nhttps://github.com/joeverson');}
    },
    {
        term: 'horse',
        category: 'interarion',
        action: function(){$('body').prepend('<div class="fantasma"><audio controls autoplay="autoplay"><source src="http://www.w3schools.com/tags/horse.ogg" type="audio/ogg"><source src="http://www.w3schools.com/tags/horse.mp3" type="audio/mpeg">Your browser does not support the audio tag.</audio></div>'); $('.fantasma').css({opacity: '0', floar: 'left', position: 'absolute', top:'0', left: '0'});}
    },
    {
        term:'login',
        category: 'auth',
        action: function(){
            $('.home').hide();
            $('.signin').fadeIn('slow');
        }
    },
    {
        term:'home',
        category: 'normal',
        action: function(){
            $('.signin').hide();
            $('.home').fadeIn('slow');
        }
    },
    {
        term:'list',
        category: 'info',
        action: function(){
            $('.home').hide();
            $('.list').fadeIn('slow');
        }
    },
    {
        term:'sair',
        category: 'auth',
        action: function(){
            window.location.href="login/logout";
        }
    },
    {
        term:'people',
        category: 'auth',
        action: function(){
            $.ajax({
                url:'pages/people.php',
                type:'post',
                data:'',
                datatype:'html',
                success: function(e){
                    $('#myModalLabel').html('Add people...');
                    $('.modal-body').html(e);
                    $('#myModal').modal('show');
                }
            });
        }
    },
    {
        term:'help',
        category: 'help',
        action: function(){
            $.ajax({
                url:'pages/help.html',
                type:'post',
                data:'',
                datatype:'html',
                success: function(e){
                    $('#myModalLabel').html('Help...');
                    $('.modal-body').html(e);
                    $('#myModal').modal('show');
                }
            });
        }
    }
];
