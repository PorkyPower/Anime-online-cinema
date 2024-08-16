
        $(document).on('click', '.watch', function  () {
            window.location.pathname = '/'+$(this).attr('idanime');
        });
    

        $(document).on('click', '.favorite', function  () {
            if (infouser.id){
                var act_val = 0;
                if ($(this).hasClass('checkedbtn')){
                    var act_val = 0;
                    $(this).removeClass('checkedbtn');
                } else {
                    var act_val = 1;
                    $(this).addClass('checkedbtn');
                }
                $.ajax({
                    url: 'http://'+window.location.host+'/api/act_fav/'+infouser.token+'/'+act_val+'/'+$(this).attr('idanime'), 
                    method: 'get',
                    dataType: 'html',
                    success: function(){ 
                        }
                });
            } else {
                showpop('Доступно только авторизованным');
            }
            
        });
        $(document).on('click', '.view', function  () {
            if (infouser.id){
               var act_val = 0;
                if ($(this).hasClass('checkedbtn')){
                    var act_val = 0;
                    $(this).removeClass('checkedbtn');
                } else {
                    var act_val = 1;
                    $(this).addClass('checkedbtn');
                }
                $.ajax({
                    url: 'http://'+window.location.host+'/api/act_view/'+infouser.token+'/'+act_val+'/'+$(this).attr('idanime'), 
                    method: 'get',
                    dataType: 'html',
                    success: function(data){ 
                    }
                });
            } else {
                showpop('Доступно только авторизованным');
            }

            
        });