let activesite = true;

        $(document).click(function (e) { 
            if ($(e.target).closest('#menu-profile').length) {
                $('#menu-show-profile').attr('status','open');
                $('#menu-show-profile').fadeIn('fast');
            return;
            }

            if ($(e.target).closest('#menu-show-profile').length) {
            return;
            }     
            
            if ($('#menu-show-profile').attr('status')=='open'){
                $('#menu-show-profile').attr('status','');
                $('#menu-show-profile').fadeOut('fast');
            }
        });
        $(document).click(function (e) { 
            if ($(e.target).closest('#menu-notice').length) {
                $('#menu-show-notice').attr('status','open');
                $('#menu-show-notice').fadeIn('fast');
            return;
            }

            if ($(e.target).closest('#menu-show-notice').length) {
            return;
            }     
            
            if ($('#menu-show-notice').attr('status')=='open'){
                $('#menu-show-notice').attr('status','');
                $('#menu-show-notice').fadeOut('fast');
            }
        });
        
        
    $('.menumobileclose').on('click', function(){
        if ($('#menublock_mobile').attr('status')=='open'){
            $('#menublock_mobile').attr('status','');
            $('#menublock_mobile').fadeOut('slow');
              $("#menublock_mobile").children('nav').animate({
                width: '0'
              },'slow');
        return;
        }
    });   
    $(document).click(function (e) { 
        if ($(e.target).closest('#menu_mobile_icon').length) {
            if ($('#menublock_mobile').attr('status')=='open'){
                $('#menublock_mobile').attr('status','');
                $('#menublock_mobile').fadeOut('slow');
                  $("#menublock_mobile").children('nav').animate({
                    width: '0'
                  },'slow');
            return;
            }
            
            $('#menublock_mobile').attr('status','open');
            $('#menublock_mobile').fadeIn('slow');
              $("#menublock_mobile").children('nav').animate({
                width: '300px'
              },'slow');
        return;
        }

        if ($(e.target).closest('#menublock_mobile').length) {
            return;
        }   

        if ($('#menublock_mobile').attr('status')=='open'){
            $('#menublock_mobile').attr('status','');
            $('#menublock_mobile').fadeOut('fast');
              $("#menublock_mobile").children('nav').animate({
                width: '0'
              },'slow');
        }
    });

        
            getnotice();
                setInterval(getnotice, 3000);


            function getnotice(){
                if (activesite){
                    $.ajax({
                        url: 'http://'+window.location.hostname+'/api/getnotice',
                        method: 'GET',
                        dataType: 'json',
                        success: function(data){
                            $('#menu-show-notice').html('');
                            $('#menu-notice-count').html(data.count);
                            for(i=0;i<data.data.length;i++){
                                if (data.count>0){
                                    $('#menu-notice-count').css('display','block');
                                } else {
                                    $('#menu-notice-count').css('display','none');
                                }
                                if (data.data[i].type == 0){
                                    let jsdate = new Date(data.data[i].date * 1000);
                                    $('#menu-show-notice').append('<div id=notice-msgs><img src=http://SITE/imgs/ico.png><div id=notice-msg-con><div>'+data.data[i].msg+'</div><div id=notice-date>'+('0' + jsdate.getHours()).slice(-2)+':'+('0' + jsdate.getSeconds()).slice(-2)+'</div></div></div>');
                                }
                                if (data.data[i].type == 1){
                                    let jsdate = new Date(data.data[i].date * 1000);
                                    $('#menu-show-notice').append('<div id=notice-msgs><div id=subs><div id=ava-prof style=background:url(http://SITE/imgs/users/ava/'+data.data[i].avatar+');background-size:cover;></div></div><div id=notice-msg-con><div><a href=../id'+data.data[i].attch+'>'+data.data[i].name+'&nbsp;</a>'+data.data[i].msg+'</div><div id=notice-date>'+('0' + jsdate.getHours()).slice(-2)+':'+('0' + jsdate.getSeconds()).slice(-2)+'</div></div></div>');
                                }
                            }

                        }
                    });
                }
            }

            $('#menu-notice').on('click', function(){
                $.get('http://'+window.location.hostname+'/api/getnotice/1');
            });
            
            $('#inp_search').on('keydown', function(){
        if ($('#inp_search').val() == ''){
            return;
        } else {
              delay(function(){
                search()
              }, 1000 );
        }
    });
    var delay = (function(){
      var timer = 0;
      return function(callback, ms){
      clearTimeout (timer);
      timer = setTimeout(callback, ms);
     };
    })();
    function search(){
        $.ajax({
            url: 'http://'+window.location.hostname+'/api/search',
            method: 'POST',
            dataType: 'json',
            data: {find: $('#inp_search').val()},
            success: function(data){
                console.log(data);
                $('#ressearch').html('');
                $('#ressearch').append('<a href="../'+data[0].link+'"><div id="search_data"><img src="http://SITE/imgs/temp/'+data[0].prev+'"><div id="search_con"><div>'+data[0].name+'</div><div id="search_year">'+data[0].year+'</div><div id="search_rating"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'+data[0].rating+'</div></div></div></a>');
            }
        });
    }
    
    $(document).click(function (e) { 
        if ($(e.target).closest('#menu-search').length) {
            $('#menu-show-search').attr('status','open');
            $('#menu-show-search').fadeIn('fast');
        return;
        }

        if ($(e.target).closest('#menu-show-search').length) {
            return;
        }     

        if ($('#menu-show-search').attr('status')=='open'){
            $('#menu-show-search').attr('status','');
            $('#menu-show-search').fadeOut('fast');
        }
    });


    function showpop(text, at=0, name=''){
        if (at == 1){
            $('#popmesstext').html(text);
            $('#popmess').css('display','flex');
            if (name != ''){
                $('#namepop').html(name);
                $('#namepop').css('display','block');
            }
        } else {
            $('#textmess').html(text);
            $('#popmess').css('display','flex');
            setTimeout(hidepop, 3000);
        }
    }
    function hidepop(){
        $('#popmess').fadeOut(100);
        $('#textmess').html('');
        $('#namepop').html('');
    }
    $(document).on('click', '.closepop', function  () {
        $('#popmess').fadeOut(100);
        $('#popmesstext').html('');
    });
    $(document).on('click', '#popbackgr', function  () {
        $('#popmess').fadeOut(100);
        $('#popmesstext').html('');
    });
    $(document).on('mouseover', '#hint', function(){
        $('#hint').fadeOut(100);
    });
    $(document).on('mouseover', '.favorite', function(){
        setTimeout(showhint, 100, 'В запланированое', $(this).offset());
    });
    $(document).on('mouseleave', '.favorite', function(){
        $('#hint').fadeOut(100);
    });
    $(document).on('mouseover', '.view', function(){
        setTimeout(showhint, 100, 'Смотрел', $(this).offset());
    });
    $(document).on('mouseleave', '.view', function(){
        $('#hint').fadeOut(100);
    });
    
    function showhint(texthint,pos){
        if ($('#hint').css('display') == 'block'){
            return;
        }
        $('#hint').fadeIn(100);
        $('#hint').html(texthint);
        $('#hint').css({'top':pos.top-40,'left':pos.left});
    }

document.addEventListener("visibilitychange", function(){
	if (document.hidden){
        activesite = false;
	} else {
        activesite = true;  
	}
});