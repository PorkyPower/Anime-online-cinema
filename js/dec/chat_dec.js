
        $(document).on('click', '#btn-close', function  () {
            $("#chat-block-con").css('display','none');
            $("#chat-block").attr('chat','');
        });
        $(document).on('click', '#stickercat', function  () {
            show_stickers($(this).attr('numpack'));
        });
        $(document).on('click', '#openchat', function  () {
            if ($("#chat-block").attr('chat')=='open'){
                $("#chat-block").attr('chat','');
                $("#chat-block-con").css('display','none');
                return;
            }
            $("#chat-block-con").css('display','block');
            $("#chat-block").attr('chat','open');
        });
        
        function sendmsg(idst = 0){
            var attch = idst;
            if ($('#msgtext').val() == '' && attch == 0){
                return;
            }
            $.ajax({
                url: 'http://'+window.location.host+'/api/sendmsg',
                method: 'POST',
                dataType: 'html',
                data: {token:infouser.token,textmsg: $('#msgtext').val(),attch:attch},
            });
            loadchat();
            textmsg: $('#msgtext').val('');
        }
        
        $(document).on('click', '#sticker-con', function  () {
            sendmsg($(this).attr('idsticker'));
        });
        $(document).on('click', '#delchatbtn', function  () {
            $.ajax({
                url: 'http://'+window.location.host+'/api/delchatid',
                method: 'post',
                dataType: 'html',
                data: {token:infouser.token,idmsg: $(this).parents(".msg_text").attr('idmsg')},
            });
        });
        
        $(document).on('click', '#btn-msg', function  () {
                sendmsg();
        });
        
        $('#msgtext').on('keypress',function(e) {
            if(e.which == 13) {
                sendmsg();
            }
        });
        
        $(function() {
            if (infouser.id == null) {
                $('#chat-btns').html('');
            }
            const chattimer = setInterval(() => loadchat(), 1000);
            $('#chat-window').html('');
            loadchat(1);
            scrollchat();
        });
        function scrollchat(){
            const e = $("#chat-window");
            e.animate({
                scrollTop: 1200
            }, 100);
        }
        var stickers = {};
        function get_sticker(id){
            var srcstiker = '';
            for (var i=0; i<stickers.length; i++) {
                if (stickers[i].id == id){
                    srcstiker = stickers[i].source;
                }
            }
            return srcstiker;
        }
        
        let packs = [{'name':'','stickers':[]}];
        function loadsticker(subs = 0){
            var numpack = 0;
            for (var i=0; i<stickers.length; i++) {
                
                if (packs[numpack].name != '' && packs[numpack].name != stickers[i].name_pack) {
                    numpack ++;
                    packs[numpack] = {'name':  stickers[i].name_pack, 'stickers':[]};
                    packs[numpack].stickers.push({'id': stickers[i].id, 'src':stickers[i].source});
                    
                } else {
                    if (packs[numpack].stickers.length < 1){
                        packs[numpack] = {'name':  stickers[i].name_pack, 'stickers':[]};
                    }
                    packs[numpack].stickers.push({'id': stickers[i].id, 'src':stickers[i].source});
                }
            }
            if (subs == 1){
                $('#stickers-cons').html('');
                $('#typestickers').html('<div numpack="all" namepack="all" id=stickercat>Все</div>');
                for (var i=0; i < packs.length; i++) {
                    $('#typestickers').append('<div numpack="'+i+'" namepack="'+packs[i].name+'" id=stickercat>'+packs[i].name+'</div>');
                    for (var f=0; f < packs[i].stickers.length; f++) {
                        $('#stickers-cons').append('<div idsticker='+packs[i].stickers[f].id+' id="sticker-con"><img id="img-sticker" src="http://'+window.location.host+packs[i].stickers[f].src+'"></div>');
                    }
                }
            } else {
                $('#stickerbtn').css('display','none');
            }
        }
        var stickerload = 0;
        var delmsg = '<div id=delmsgchat><div id=delchatbtn><svg width="16" height="16" viewBox="0 0 132 131" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div>';
        
        var admchat = ''; 
        if (infouser.admin==1){
            admchat = delmsg; 
        }
        function show_stickers(numpack_s){   
            $('#stickers-cons').html('');    
            if (numpack_s == 'all'){
                for (var i=0; i < packs.length; i++) {
                    for (var f=0; f < packs[i].stickers.length; f++) {
                        $('#stickers-cons').append('<div idsticker='+packs[i].stickers[f].id+' id="sticker-con"><img id="img-sticker" src="http://'+window.location.host+packs[i].stickers[f].src+'"></div>');
                    }
                }
                return;
            }
            for (var f=0; f < packs[numpack_s].stickers.length; f++) {
                $('#stickers-cons').append('<div idsticker='+packs[numpack_s].stickers[f].id+' id="sticker-con"><img id="img-sticker" src="http://'+window.location.host+packs[numpack_s].stickers[f].src+'"></div>');
            }
        }
        
        function loadchat(fload = 0){
            if ($("#chat-block").attr('chat')==''){
                return;
            }
            $.ajax({
                url: 'http://'+window.location.host+'/api/loadchat'+infouser.token,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    for (var i = data[0].data.length-1; i > -1; i--) {
                        if ($('div[idmsg='+data[0].data[i].id+']').length > 0 ){
                            if (data[0].data[i].delmsg == 1){
                                $('div[idmsg='+data[0].data[i].id+']').html('');  
                            }
                        } else {
                                if (stickerload == 0){
                                    stickers = data[1].data;
                                        console.log(data[2]);
                                    if (data[2].data[0]){
                                        usersubs = data[2].data[0].subscribe
                                    }else{
                                        usersubs = 0
                                    }
                                    loadsticker(usersubs);
                                }
                                stickerload = 1;
                            if (data[0].data[i].delmsg == 0){
                                if ($('#chat-window')[0].scrollHeight-700 < $('#chat-window').scrollTop()){
                                     if (fload == 0) {
                                         scrollchat();
                                     }
                                } 
                                clr = 'darkcyan';
                                icon_prem = '';
                                if (data[0].data[i].subscribe == 1){
                                    clr = 'orange';
                                    if (data[0].data[i].typesubs == 1){
                                        clr = 'red';
                                        icon_prem = '<svg width="20" height="20" viewBox="0 0 113 117" fill="none" xmlns="http://www.w3.org/2000/svg" style="padding: 0 10px;"><path d="M53.7568 5.21382C54.9899 3.64602 57.3647 3.64602 58.5977 5.21382L67.8794 17.0192C68.6512 18.0004 69.9386 18.4187 71.1394 18.0784L85.5873 13.9834C87.5065 13.4395 89.4282 14.8357 89.5036 16.8286L90.0737 31.8351C90.1214 33.0824 90.9168 34.1776 92.0888 34.6081L106.184 39.7877C108.056 40.4755 108.79 42.7345 107.68 44.3914L99.321 56.867C98.6262 57.904 98.6262 59.2577 99.321 60.2947L107.68 72.7702C108.79 74.4271 108.056 76.686 106.184 77.3741L92.0888 82.5537C90.9168 82.9842 90.1214 84.0793 90.0737 85.3267L89.5036 100.333C89.4282 102.326 87.5065 103.722 85.5873 103.178L71.1394 99.0835C69.9386 98.7428 68.6512 99.1615 67.8794 100.143L58.5977 111.948C57.3647 113.516 54.9899 113.516 53.7568 111.948L44.4751 100.143C43.7036 99.1615 42.416 98.7428 41.2152 99.0835L26.767 103.178C24.8482 103.722 22.9265 102.326 22.8508 100.333L22.2806 85.3267C22.2332 84.0793 21.4375 82.9842 20.2659 82.5537L6.1701 77.3741C4.29812 76.686 3.56412 74.4271 4.6743 72.7702L13.0335 60.2947C13.7283 59.2577 13.7283 57.904 13.0335 56.867L4.6743 44.3914C3.56412 42.7345 4.29812 40.4755 6.1701 39.7877L20.2659 34.6081C21.4375 34.1776 22.2332 33.0824 22.2806 31.8351L22.8508 16.8286C22.9265 14.8357 24.8482 13.4395 26.767 13.9834L41.2152 18.0784C42.416 18.4187 43.7036 18.0004 44.4751 17.0192L53.7568 5.21382Z" stroke="red" stroke-width="7.69709"></path><path d="M40.7831 58.5809L51.0459 68.8437L71.5715 48.3181" stroke="red" stroke-width="7.69709" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
                                    }
                                }
                                if (infouser.id == data[0].data[i].userid){
                                    var d = new Date(+data[0].data[i].datemsg * 1000);
                                    $('#chat-window').append('<div idmsg='+data[0].data[i].id+' class=msg_text id=msg-from-me><div id=msg-from-me-con><div id=txt-msg><a href=/id'+data[0].data[i].userid+' target=_blank style="color:'+clr+';">'+data[0].data[i].login+icon_prem+'</a><div>'+(data[0].data[i].attch=='sticker' ? '<img id=img-sticker src="http://'+window.location.host+get_sticker(data[0].data[i].typeattch)+'">' : data[0].data[i].txtmsg)+'</div></div><span id=date-msg>'+d.getHours()+':'+d.getMinutes()+'</span></div>'+admchat+'</div>'); 
                                } else {
                                    var d = new Date(+data[0].data[i].datemsg * 1000);
                                    $('#chat-window').append('<div idmsg='+data[0].data[i].id+' class=msg_text id=msg-from-users><div id=msg-from-users-con><div id=txt-msg><a href=/id'+data[0].data[i].userid+' target=_blank style="color:'+clr+';">'+data[0].data[i].login+icon_prem+'</a><div>'+(data[0].data[i].attch=='sticker' ? '<img id=img-sticker src="http://'+window.location.host+get_sticker(data[0].data[i].typeattch)+'">' : data[0].data[i].txtmsg)+'</div></div><span id=date-msg>'+d.getHours()+':'+d.getMinutes()+'</span></div>'+admchat+'</div>');
                                }   
                            }
                        }
                    }
                }
            });
        }
        $(document).click(function (e) { 
            if ($(e.target).closest('#stickerbtn').length) {
                $('#stickerblock').attr('status','open');
                $('#stickerblock').fadeIn('fast');
            return;
            }

            if ($(e.target).closest('#stickerblock').length) {
                return;
            }     

            if ($('#stickerblock').attr('status')=='open'){
                $('#stickerblock').attr('status','');
                $('#stickerblock').fadeOut('fast');
            }
        });