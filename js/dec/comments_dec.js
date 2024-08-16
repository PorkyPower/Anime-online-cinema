   $('body').on('paste', function(e) { 
        
        if ($(':focus').attr('id') == 'inputtext'){
            e.preventDefault();
            var pasteData = e.originalEvent.clipboardData.getData('text');
            document.execCommand('inserttext', false, pasteData);
            return;
        }
    });
    
    
    var sendtext = '';
    var sendidreply = 0;
    var senduserreply = 0;
    $('body').on('keydown',function(e) {
        if (e.keyCode == 13 && !e.shiftKey)
        {
            sendidreply = 0;
            senduserreply = 0;
            if ($(':focus').attr('id') == 'inputtext'){
                sendtext = $(':focus').html();
                if ($(':focus').attr('reply') == 'text'){
                    sendidreply = $(':focus').parents('#comms-form').attr('form_id');
                    senduserreply = $(':focus').parent().children('#reply_id_comm').attr('value');
                    $('div[reply_form=on]')[0].outerHTML = '';
                }
                $(':focus').html('');
                e.preventDefault();
                sendcomm();
                
                return false;
            }
        }
    });
    
    var sendid = 0;
    var ratval = '';
    $(document).on('click', '#rating_up', function  () {    
        sendid = $(this).parents('[id_comm]').attr('id_comm');
        ratval = 'up';
        sendrating();
    });
    $(document).on('click', '#rating_down', function  () {
        sendid = $(this).parents('[id_comm]').attr('id_comm');
        ratval = 'down';
        sendrating();
    });
    
    $(document).on('click', '#sendcom', function  () {
            sendidreply = 0;
            senduserreply = 0;
            sendtext = $(this).parents('[id=comms-form]').children().children('#inputtext').html();
            if ($(this).parents('[id=comms-form]').attr('reply_form')=='on'){
                sendidreply = $(this).parents('[id=comms-form]').attr('form_id');
                senduserreply = $(this).parents('[id=comms-form]').children().children('[id="reply_id_comm"]').attr('value');
            }
            sendcomm();
            return false;
    });
    
    
    function sendrating(){
        $.ajax({
            url: "http://"+window.location.host+"/api/sendratingcomm",
            method:'post',
            dataType: 'html',
            data:{token:infouser.token,path: location.pathname,sendid:sendid,rating:ratval},
            success: function(data){
                console.log(data);
                if (data == ''){
                    data = '0';
                }
                $("div[id_comm="+sendid+"]").children('#comm_head').children('#comm_rating').children('#count_rating').html(data);
            }
        });
    } 
    
    function sendcomm(){
        $.ajax({
            url: "http://"+window.location.host+"/api/sendcomm",
            method:'post',
            dataType: 'html',
            data:{token:infouser.token,path: location.pathname,sendtext:sendtext,sendidreply:sendidreply,senduserreply:senduserreply},
            success: function(data){
                console.log(data);
            }
        });
    }

    $(function() {
        
        loadcomments();
        
        if (infouser.id == null) {
            $('#comms-form').css('height','5%');
            $('#comms-form').html('Доступно только авторизованным!');
        }
        const loadcomms = setInterval(() => loadcomments(), 1500);
    });

    
    var reply_name = '';
    var idrepl = '';
    var namerepl = '';
    var id_reply_comm= '';
    $(document).on('click', '#reply_comm', function  () {
        
        if (infouser.id == null) {
            return;
        }
        if ($(this).parents("div[typecomm=reply_comm]").length || $('[replay_comm='+$(this).parent().attr('id_comm')+']').length){
            
                if (typeof ($(this).parents('div[id=comm]').attr('id_comm')) != 'undefined'){ // parrent
                    form_id=$(this).parents('div[id=comm]').attr('id_comm');
                } else {
                    form_id=$(this).parents('div[id=child-comments]').attr('replay_comm');
                }
            if ($('div[reply_form=on]').length){
                $('div[reply_form=on]')[0].outerHTML = '';
            }
            
            if ($('div[reply_form=on][form_id='+form_id+']').length){
                if ($('div[form_id='+form_id+']').children('#reply_id_comm').attr('idreply') != id_reply_comm){
                    reply_text = $('[idreply='+id_reply_comm+']').parent().children('div#inputtext').html();
                    reply_text = reply_text.replace(namerepl+',', $(this).parent().attr('author_name')+',');
                    if (reply_text == ''){
                        reply_text = $(this).parent().attr('author_name')+',';
                    }
                    $('[idreply='+id_reply_comm+']').parent().children('div#inputtext').html(reply_text);
                    $('[idreply='+id_reply_comm+']').attr('idreply',$(this).parent().attr('id_comm'));
                }
                
                if (typeof ($(this).parents('div[id=comm]').attr('id_comm')) != 'undefined'){ // parrent
                    form_id=$(this).parents('div[id=comm]').attr('id_comm');
                    idrepl = $('[id_comm='+form_id+']').attr('author_id');
                    namerepl = $('[id_comm='+form_id+']').attr('author_name');
                    id_reply_comm = $('[id_comm='+form_id+']').attr('id_comm');
                } else {
                    idrepl = $(this).parent().attr('author_id');
                    namerepl = $(this).parent().attr('author_name');
                    id_reply_comm = $(this).parent().attr('id_comm');
                }
                
                
                $('[idreply='+id_reply_comm+']').attr('value',idrepl);
              
                $('div[reply_form=on][form_id='+form_id+']').children().children('#inputtext').get(0).focus();
                let collapse = window.getSelection();
                collapse.selectAllChildren($('div[reply_form=on][form_id='+form_id+']').children().children('#inputtext').get(0));
                collapse.collapseToEnd();
                return;
            }
            
            if (typeof ($(this).parents('div[id=comm]').attr('id_comm')) != 'undefined'){ // parrent
                form_id=$(this).parents('div[id=comm]').attr('id_comm');
                
                idrepl = $('[id_comm='+form_id+']').attr('author_id');
                namerepl = $('[id_comm='+form_id+']').attr('author_name');
                id_reply_comm = $('[id_comm='+form_id+']').attr('id_comm');
            } else {
                form_id=$(this).parents('div[id=child-comments]').attr('replay_comm');
                
                idrepl = $(this).parent().attr('author_id');
                namerepl = $(this).parent().attr('author_name');
                id_reply_comm = $(this).parent().attr('id_comm');
            }
            
            sendform = '<div reply_form=on form_id='+form_id+' id="comms-form"><div><input id="reply_id_comm" idreply='+id_reply_comm+' type="text" hidden="" value='+idrepl+'><div id="inputtext" reply=text placeholder="Напишите комментарий" contenteditable="true">'+namerepl+',&nbsp;</div></div><div><div id=sendcom><svg width="24" height="24" viewBox="0 0 124 106" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M119.055 52.785L4.97217 100.82L26.3628 52.785L4.97217 4.74994L119.055 52.785Z" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/><path d="M25.9875 52.785H119.056" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div>';
            if ($(this).parent().attr('id') == 'comm'){
                $('[replay_comm='+$(this).parent().attr('id_comm')+']').append(sendform);
            } else {
                $(this).parents("#child-comments").append(sendform);
            }
            $('[reply]').html();
            //console.log(document.querySelector('[reply').getBoundingClientRect().top);
                $('div[reply_form=on][form_id='+form_id+']').children().children('#inputtext').get(0).focus();
                let collapse = window.getSelection();
                collapse.selectAllChildren($('div[reply_form=on][form_id='+form_id+']').children().children('#inputtext').get(0));
                collapse.collapseToEnd();
            return;
        } else {
            id_comm = $(this).parent().attr('id_comm');
            var makelist = '<div replay_comm="'+id_comm+'" id="child-comments"></div>';
            $(this).parent()[0].outerHTML = $(this).parent()[0].outerHTML+makelist;
            $('[id_comm='+id_comm+']').children('#reply_comm').trigger('click');
        }
    });
    function loadcomments(){
        if (activesite){
            $.ajax({
                url: "http://"+window.location.host+"/api/getcomms",
                method: "post",
                dataType: "json",
                data: {token:infouser.token,path: location.pathname},
                success: function(data){
                    console.log(data);
                    for (var i=0; i<data.items.length; i++) {
                            var d = new Date();
                            var dd = new Date(data.items[i].date * 1000);
                            var daycomm = '';
                            if (d.getFullYear() === dd.getFullYear() && d.getMonth() === dd.getMonth() && d.getDate() === dd.getDate()){
                                daycomm = 'Сегодня в '+dd.getHours()+':'+dd.getMinutes();
                            } else if (d.getFullYear() === dd.getFullYear() && d.getMonth() === dd.getMonth() && d.getDate()-1 === dd.getDate()){
                                daycomm = 'Вчера в '+dd.getHours()+':'+dd.getMinutes();
                            } else {
                                daycomm = dd.getDate()+'.'+(dd.getMonth()+1)+' '+dd.getHours()+':'+dd.getMinutes();
                            }
                            if ($('div[id_comm='+data.items[i].id+']').length < 1){
                                $('#cooms-count').html('Комментарии '+data.count);
                                border = '';
                                if (data.items[i].border != 0){
                                    border = '<div id=border_user style="background: url(http://SITE/imgs/users/borders/'+data.items[i].border+');'+data.items[i].border_pos+'"></div>';
                                }
                                clr = 'color:cadetblue';
                                prem = '';
                                if (data.items[i].subs == 1){
                                    clr='color:orange';
                                } else if (data.items[i].subs == 2){
                                    clr='color:red'; 
                                    prem= '<svg width="20" height="20" viewBox="0 0 113 117" fill="none" xmlns="http://www.w3.org/2000/svg" style="padding: 0 10px;"><path d="M53.7568 5.21382C54.9899 3.64602 57.3647 3.64602 58.5977 5.21382L67.8794 17.0192C68.6512 18.0004 69.9386 18.4187 71.1394 18.0784L85.5873 13.9834C87.5065 13.4395 89.4282 14.8357 89.5036 16.8286L90.0737 31.8351C90.1214 33.0824 90.9168 34.1776 92.0888 34.6081L106.184 39.7877C108.056 40.4755 108.79 42.7345 107.68 44.3914L99.321 56.867C98.6262 57.904 98.6262 59.2577 99.321 60.2947L107.68 72.7702C108.79 74.4271 108.056 76.686 106.184 77.3741L92.0888 82.5537C90.9168 82.9842 90.1214 84.0793 90.0737 85.3267L89.5036 100.333C89.4282 102.326 87.5065 103.722 85.5873 103.178L71.1394 99.0835C69.9386 98.7428 68.6512 99.1615 67.8794 100.143L58.5977 111.948C57.3647 113.516 54.9899 113.516 53.7568 111.948L44.4751 100.143C43.7036 99.1615 42.416 98.7428 41.2152 99.0835L26.767 103.178C24.8482 103.722 22.9265 102.326 22.8508 100.333L22.2806 85.3267C22.2332 84.0793 21.4375 82.9842 20.2659 82.5537L6.1701 77.3741C4.29812 76.686 3.56412 74.4271 4.6743 72.7702L13.0335 60.2947C13.7283 59.2577 13.7283 57.904 13.0335 56.867L4.6743 44.3914C3.56412 42.7345 4.29812 40.4755 6.1701 39.7877L20.2659 34.6081C21.4375 34.1776 22.2332 33.0824 22.2806 31.8351L22.8508 16.8286C22.9265 14.8357 24.8482 13.4395 26.767 13.9834L41.2152 18.0784C42.416 18.4187 43.7036 18.0004 44.4751 17.0192L53.7568 5.21382Z" stroke="red" stroke-width="7.69709"></path><path d="M40.7831 58.5809L51.0459 68.8437L71.5715 48.3181" stroke="red" stroke-width="7.69709" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
                                }
                                $('#comms-list').append('<div id_comm='+data.items[i].id+' author_id='+data.items[i].iduser+' author_name='+data.items[i].name+' id=comm><div id=comm_head><div typecomm=comm id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar style=background:url(http://SITE/imgs/users/ava/'+data.items[i].avatar_user+')>'+border+'</div></div><a style="'+clr+'" target="_blank" href="../id'+data.items[i].iduser+'">'+data.items[i].name+'</a>'+prem+'</div><div id=comm_rank>'+data.items[i].rank+'</div><div id=comm_date>'+daycomm+'</div><div id=comm_rating><div id=rating_up><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 115.345V7.03797M58.5064 7.03797L110.494 59.0253M58.5064 7.03797L6.51901 59.0253" stroke="lime" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div id=count_rating>'+data.items[i].rating+'</div><div id=rating_down><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 7.03797V115.345M58.5064 115.345L6.51901 63.3576M58.5064 115.345L110.494 63.3576" stroke="red" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div><div id=comm_cont>'+data.items[i].text+'</div><div id=reply_comm>Ответить</div></div>');
                            }

                            if (typeof(data.items[i].thead) != 'undefined'){

                                if ($('div[replay_comm='+data.items[i].id+']').length < 1){
                                    $('#comms-list').append('<div replay_comm='+data.items[i].id+' id=child-comments></div>');
                                }
                                for (var f=0; f<data.items[i].thead.length; f++) {
                                    var d = new Date();
                                    var dd = new Date(data.items[i].thead[f].date * 1000);
                                    var daycomm = '';
                                    if (d.getFullYear() === dd.getFullYear() && d.getMonth() === dd.getMonth() && d.getDate() === dd.getDate()){
                                        daycomm = 'Сегодня в '+dd.getHours()+':'+dd.getMinutes();
                                    } else if (d.getFullYear() === dd.getFullYear() && d.getMonth() === dd.getMonth() && d.getDate()-1 === dd.getDate()){
                                        daycomm = 'Вчера в '+dd.getHours()+':'+dd.getMinutes();
                                    } else {
                                        daycomm = dd.getDate()+'.'+(dd.getMonth()+1)+' '+dd.getHours()+':'+dd.getMinutes();
                                    }
                                    if ($('div[id_comm='+data.items[i].thead[f].id+']').length < 1){

                                        $('#cooms-count').html('Комментарии '+data.count);
                                        border = '';
                                        if (data.items[i].thead[f].border != 0){
                                            border = '<div id=border_user style="background: url(http://SITE/imgs/users/borders/'+data.items[i].thead[f].border+');'+data.items[i].thead[f].border_pos+'"></div>';
                                        }                            
                                        clr = 'color:cadetblue';
                                        prem = '';
                                        if (data.items[i].thead[f].subs == 1){
                                            clr='color:orange';
                                        } else if (data.items[i].thead[f].subs == 2){
                                            clr='color:red';
                                            prem= '<svg width="20" height="20" viewBox="0 0 113 117" fill="none" xmlns="http://www.w3.org/2000/svg" style="padding: 0 10px;"><path d="M53.7568 5.21382C54.9899 3.64602 57.3647 3.64602 58.5977 5.21382L67.8794 17.0192C68.6512 18.0004 69.9386 18.4187 71.1394 18.0784L85.5873 13.9834C87.5065 13.4395 89.4282 14.8357 89.5036 16.8286L90.0737 31.8351C90.1214 33.0824 90.9168 34.1776 92.0888 34.6081L106.184 39.7877C108.056 40.4755 108.79 42.7345 107.68 44.3914L99.321 56.867C98.6262 57.904 98.6262 59.2577 99.321 60.2947L107.68 72.7702C108.79 74.4271 108.056 76.686 106.184 77.3741L92.0888 82.5537C90.9168 82.9842 90.1214 84.0793 90.0737 85.3267L89.5036 100.333C89.4282 102.326 87.5065 103.722 85.5873 103.178L71.1394 99.0835C69.9386 98.7428 68.6512 99.1615 67.8794 100.143L58.5977 111.948C57.3647 113.516 54.9899 113.516 53.7568 111.948L44.4751 100.143C43.7036 99.1615 42.416 98.7428 41.2152 99.0835L26.767 103.178C24.8482 103.722 22.9265 102.326 22.8508 100.333L22.2806 85.3267C22.2332 84.0793 21.4375 82.9842 20.2659 82.5537L6.1701 77.3741C4.29812 76.686 3.56412 74.4271 4.6743 72.7702L13.0335 60.2947C13.7283 59.2577 13.7283 57.904 13.0335 56.867L4.6743 44.3914C3.56412 42.7345 4.29812 40.4755 6.1701 39.7877L20.2659 34.6081C21.4375 34.1776 22.2332 33.0824 22.2806 31.8351L22.8508 16.8286C22.9265 14.8357 24.8482 13.4395 26.767 13.9834L41.2152 18.0784C42.416 18.4187 43.7036 18.0004 44.4751 17.0192L53.7568 5.21382Z" stroke="red" stroke-width="7.69709"></path><path d="M40.7831 58.5809L51.0459 68.8437L71.5715 48.3181" stroke="red" stroke-width="7.69709" stroke-linecap="round" stroke-linejoin="round"></path></svg>';
                                        }
                                        $('div[replay_comm='+data.items[i].id+']').append('<div id_comm='+data.items[i].thead[f].id+' typecomm=reply_comm author_name='+data.items[i].thead[f].name+' author_id='+data.items[i].thead[f].iduser+' id=reply_comment><div id=comm_head><div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar style=background:url(http://SITE/imgs/users/ava/'+data.items[i].thead[f].avatar_user+')>'+border+'</div></div><a style="'+clr+'" target="_blank" href="../id'+data.items[i].thead[f].iduser+'">'+data.items[i].thead[f].name+'</a>'+prem+'</div><div id=comm_rank>'+data.items[i].thead[f].rank+'</div><div id=comm_date>'+daycomm+'</div><div id=comm_rating><div id=rating_up><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 115.345V7.03797M58.5064 7.03797L110.494 59.0253M58.5064 7.03797L6.51901 59.0253" stroke="lime" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div id=count_rating>'+data.items[i].thead[f].rating+'</div><div id=rating_down><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 7.03797V115.345M58.5064 115.345L6.51901 63.3576M58.5064 115.345L110.494 63.3576" stroke="red" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div><div id=comm_cont>'+data.items[i].thead[f].text+'</div><div id=reply_comm>Ответить</div></div>');
                                    }
                                }
                        }
                    }

                }
            });
        }
    }
