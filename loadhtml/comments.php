
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<style>
    body {
        background: #201F28;
        color: lightgrey;
        font-size: 14pt;
    }
    #comms-block{
        width: 70%;
        margin-left: 15%;
    }
    #comms-block > div{
        margin: 1%;
    }
    #inputtext{
        width: 300px;
        outline: none;
        resize: none; 
        font-size: 12pt;
        border: 2px solid #0000004a;
        border-radius: 10px;
        padding: 8px;
    }
    #cooms-count{
        width: 96%;
        height: 20px;
        background: #0000004a;
        padding: 1%;
    }
    #comms-form{
        display: flex;
        align-items: center;
    }
    #comms-form > div{
        margin: 5px;
    }
    #sendcom{
        display: flex;
        color: white;
        background: #F84134;
        border-radius: 10px;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        border: 0;
        padding: 4px;
    }
    
    
    #comm_head{
        display: flex;
        align-items: center;
    }
    #comm_head > div{
        display: flex;
        margin-right: 10px;
        align-items: center;
    }
    #comm_author_avatar{
        width: 30px;
        height: 30px;
        border-radius: 150px;   
        background: url(http://SITE/imgs/users/ava/4.png);
        background-size: cover !important;    
        background-position: center !important;
    }
    #comm_author_avatar_outline{
        width: 30px;
        height: 30px;
        padding: 1px;
        background: white;
        border-radius: 150px;
        margin-right: 10px;
    }
    #comm_author_name > a{
        text-decoration: none;
        color: cadetblue;
        font-size: 16pt;
    }
    #comm_date{
        font-size: 10pt;
        cursor: default;
    }
    #comm > div{
        margin-bottom: 10px;
    }
    #reply_comm{
        font-size: 12pt;
        cursor: pointer;
        color: indianred;
    }
    #comm{
        display: grid;
        justify-items: start;
    }
    #reply_comment{
        display: grid;
        justify-items: start;
    }
    #comms-list > div{
        margin-bottom: 2%;
    }
    #reply_comment > div{
        margin-bottom: 2%;
    }
    #child-comments > div{
        margin-bottom: 2%;
        margin-left: 40px;
    }
    #child-comments{
        border-left: 1px solid #0000004a;
    }
    [contenteditable=true]:empty:before{
        content: attr(placeholder);
        pointer-events: none;
        display: block;
        color: lightgray;
    }
    #comm_cont{
        cursor:default;
    }
    #comm_rating{
        
    }
    #comm_rating > div{
        width: 30px;
        height: 30px;    
        display: flex;
        justify-content: center;
        align-items: center;
    }
    #rating_up{
        background: #0000004a;
        cursor: pointer;
        border-radius: 5px 0 0 5px;
    }
    #rating_down{
        background: #0000004a;
        cursor: pointer;
        border-radius: 0 5px 5px 0;
    }
    #count_rating{
        background: #0000004a;
        cursor: default;
    }
    #hint{
        position: absolute;
        top: 0;
        left: 0;
        background: #0000004a;
        padding: 5px;
    }
</style>


<div id=comms-block>
    <div id=cooms-count>Комментарии</div>
    <div>Написать комментарий</div>
    <div id=comms-form><div><input type="text" hidden id=reply_id_comm value=""><div id=inputtext placeholder='Напишите комментарий' contenteditable="true"></div></div><div><div id=sendcom><svg width="24" height="24" viewBox="0 0 124 106" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M119.055 52.785L4.97217 100.82L26.3628 52.785L4.97217 4.74994L119.055 52.785Z" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M25.9875 52.785H119.056" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div></div></div>
    <div id=comms-list>
<!--
        <div id_comm=1 author_id=4 author_name=ezh id=comm>
            <div id=comm_head>                <div id=comm_rating>
                    <div id=rating_up><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M58.5064 115.345V7.03797M58.5064 7.03797L110.494 59.0253M58.5064 7.03797L6.51901 59.0253" stroke="lime" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                    <div id=count_rating>0</div>
                    <div id=rating_down><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M58.5064 7.03797V115.345M58.5064 115.345L6.51901 63.3576M58.5064 115.345L110.494 63.3576" stroke="red" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                </div>
                <div typecomm=comm id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar></div></div><a target="_blank" href="./id4">ezh</a></div>
                <div id=comm_date>02.11 18:15</div>

            </div>
            <div id=comm_cont>Когда-то начал читать и понял что это про супер-пупер умного восьмилетнего пацана, которому взрослые и в подмётки не годятся по уровню интеллекта. И в общем-то на этой ноте и закончилось ознакомление.</div>
            <div id=reply_comm>Ответить</div>
        </div>
            <div replay_comm=1 id=child-comments>
                <div id_comm=3 typecomm=reply_comm author_name=ezh author_id=4 id=reply_comment>
                    <div id=comm_head>
                        <div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar></div></div><a target="_blank" href="./id4">ezh</a></div>
                        <div id=comm_date>02.11 18:15</div>
                    </div>
                    <div id=comm_cont>Когда-то начал читать и понял что это про супер-пупер умного восьмилетнего пацана, которому взрослые и в подмётки не годятся по уровню интеллекта. И в общем-то на этой ноте и закончилось ознакомление.</div>
                    <div id=reply_comm>Ответить</div>
                </div>
                <div id_comm=4 typecomm=reply_comm author_name=ani author_id=2 id=reply_comment>
                    <div id=comm_head>
                        <div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar></div></div><a target="_blank" href="./id4">ani</a></div>
                        <div id=comm_date>02.11 18:15</div>
                    </div>
                    <div id=comm_cont>Когда-то начал читать и понял что это про супер-пупер умного восьмилетнего пацана, которому взрослые и в подмётки не годятся по уровню интеллекта. И в общем-то на этой ноте и закончилось ознакомление.</div>
                    <div id=reply_comm>Ответить</div>
                </div>
            </div>
        <div id_comm=2 author_id=2 author_name=ani id=comm>
            <div id=comm_head>
                <div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar></div></div><a target="_blank" href="./id4">ani</a></div>
                <div id=comm_date>02.11 18:15</div>
            </div>
            <div id=comm_cont>калитка должна быть на первом, а не на втором. алхимик куда менее хорош</div>
            <div id=reply_comm>Ответить</div>
        </div>
        <div id_comm=15 author_id=2 author_name=ani id=comm>
            <div id=comm_head>
                <div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar></div></div><a target="_blank" href="./id2">ani</a></div>
                <div id=comm_date>02.11 18:15</div>
            </div>
            <div id=comm_cont>калитка должна быть на первом, а не на втором. алхимик куда менее хорош</div>
            <div id=reply_comm>Ответить</div>
        </div>
-->
    </div>
</div>
<div id="hint">
    sad
</div>
<script>
    
    infouser = {id:1,
               token: "73970ff077a59f1cb8db6613d7619ad2353e4dfa64f1d390ea05909b635516de"};
    
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
    
    $(document).on('mouseover', '#comm_date', function(){
        setTimeout(showhint, 500, 'Время', $(this)[0].getBoundingClientRect().top-40, $(this)[0].getBoundingClientRect().left);
    });
    $(document).on('mouseleave', '#comm_date', function(){
        $('#hint').fadeOut(100);
    });
    function showhint(texthint,top,left){
        $('#hint').fadeIn(100);
        $('#hint').html(texthint);
        $('#hint').css({'top':top,'left':left});
    }
    
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
        $.ajax({
            url: "http://"+window.location.host+"/api/getcomms",
            method: "post",
            dataType: "json",
//            data: {token:infouser.token,path: location.pathname},
            data: {token:infouser.token,path: '/2/s1_e1'},
            success: function(data){
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
                            $('#comms-list').append('<div id_comm='+data.items[i].id+' author_id='+data.items[i].iduser+' author_name='+data.items[i].name+' id=comm><div id=comm_head><div typecomm=comm id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar style=background:url(http://SITE/imgs/users/ava/'+data.items[i].avatar_user+')></div></div><a target="_blank" href="./id'+data.items[i].iduser+'">'+data.items[i].name+'</a></div><div id=comm_date>'+daycomm+'</div><div id=comm_rating><div id=rating_up><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 115.345V7.03797M58.5064 7.03797L110.494 59.0253M58.5064 7.03797L6.51901 59.0253" stroke="lime" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div id=count_rating>'+data.items[i].rating+'</div><div id=rating_down><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 7.03797V115.345M58.5064 115.345L6.51901 63.3576M58.5064 115.345L110.494 63.3576" stroke="red" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div><div id=comm_cont>'+data.items[i].text+'</div><div id=reply_comm>Ответить</div></div>');
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
                                    $('div[replay_comm='+data.items[i].id+']').append('<div id_comm='+data.items[i].thead[f].id+' typecomm=reply_comm author_name='+data.items[i].thead[f].name+' author_id='+data.items[i].thead[f].iduser+' id=reply_comment><div id=comm_head><div id=comm_author_name><div id=comm_author_avatar_outline><div id=comm_author_avatar style=background:url(http://SITE/imgs/users/ava/'+data.items[i].thead[f].avatar_user+')></div></div><a target="_blank" href="./id'+data.items[i].thead[f].iduser+'">'+data.items[i].thead[f].name+'</a></div><div id=comm_date>'+daycomm+'</div><div id=comm_rating><div id=rating_up><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 115.345V7.03797M58.5064 7.03797L110.494 59.0253M58.5064 7.03797L6.51901 59.0253" stroke="lime" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div><div id=count_rating>'+data.items[i].thead[f].rating+'</div><div id=rating_down><svg width="12" height="12" viewBox="0 0 117 122" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M58.5064 7.03797V115.345M58.5064 115.345L6.51901 63.3576M58.5064 115.345L110.494 63.3576" stroke="red" stroke-width="12.9968" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div></div><div id=comm_cont>'+data.items[i].thead[f].text+'</div><div id=reply_comm>Ответить</div></div>');
                                }
                            }
                    }
                }
                
            }
        });
    }

    

</script>