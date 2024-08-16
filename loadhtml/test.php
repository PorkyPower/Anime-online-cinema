
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>



<style>
    body {
        background: #201F28;
    }
#chat-window{
    height: 500px;
    background: #201F28;
    overflow:hidden;
    overflow-y:scroll;
    scrollbar-color: black red;
    border: 1px solid black;
    color: black;
    font-size: 10pt;
}
.scrollstyle::-webkit-scrollbar{
    width: 3px;
}
.scrollstyle::-webkit-scrollbar-thumb{
    background: red;
}
.scrollstyle::-webkit-scrollbar-track{
    background: black;
}
#chat-btns{
    display: flex;
    justify-content: space-between;
    width: 100%;
    border: 1px solid black;
    align-items: center;
}
#msg-from-me{
    display: flex;
    justify-content: flex-end;
    margin: 1%;
}
#msg-from-me-con{
    background: #FBFFEF;
    border-radius: 15px;
    padding: 2% 5%;
    max-width: 250px;
    display: flex;
    align-items: flex-end;
}
#msg-from-users{
    display: flex;
    justify-content: space-between;
    margin: 1%;
}
#msg-from-users-con{
    background: #FFE0DD;
    border-radius: 15px;
    padding: 2% 5%;
    max-width: 250px;
    display: flex;
    align-items: flex-end;
}
#date-msg{
    font-size: 7pt;
}
#txt-msg{
    margin: 5px;
}
#txt-msg > a{
    text-decoration: none;
    color:darkcyan;
    font-weight: bold;
}
#img-sticker{
    width: 90px;
    pointer-events: none;
}
#close-chat{
    width: 100%;
    height: 30px;
    display: flex;
    background: #201F28;
    border-bottom: 1px solid white;
    align-items: center;
    border-radius: 10px 10px 0 0;
    border: 1px solid black;
}
#close-chat > div:first-child{
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    color: white;
    padding: 5%;
    font-size: 14pt;
}
#close-chat > div:last-child{
    color: white;
    padding: 3%;
    cursor: pointer;
}
#chat-block{
    position: fixed;
    bottom: 10px;
    right: 10px;
    display: flex;
    width: 380px;
    align-items: flex-end;
    justify-content: flex-end;
    z-index: 99;
    font-size: 12pt;
}
#chat-block-con{
    margin-right: 20px;
    width: 380px;
    display: none;
}
#openchat {
    display: flex;
    justify-content: flex-end;
}
#openchat svg{
    border: 1px solid red;
    border-radius: 15px;
    padding: 12px;
    cursor: pointer;        
    background: #201F28;
}
#openchat svg:hover{ 
    background: #48465B;
}
#msgtext{
    padding: 4%;
    width: 100%;
    background: #201F28;
    border: none;
    border-right: 1px solid black;
    outline: none;
    color: white;
}
#btn-msg{ 
    background: #201F28;
    border: none;
    color: red;
    cursor: pointer;
    padding: 4%;
}
#stickerbtn{
    padding: 2%;
    cursor: pointer;
}
#stickerblock{
    display: none;
    width: 0;
    height: 0;
}
#stickers-cons{
    position: absolute;
    width: 292px;
    height: 300px;
    bottom: 78px;
    background: #201F28;
    display: flex;
    flex-wrap: wrap;
    border: 1px solid black;
    align-content: flex-start;  
    overflow:hidden;
    overflow-y:scroll;
    scrollbar-color: black red;
}
#stickerblock > div > div{
    padding: 4px;
    cursor: pointer;
}
#stickerblock > div > div:hover{
    background: #48465B;
}
#stickerblock > div > div > img{
    width: 64;
    height: 64;
}
#stickerbtn:hover > #stickerblock{
    display: flex;
}
#typestickers{
    position: absolute;
    width: 288px;
    height: 40px;
    bottom: 40px;
    color: white;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    background: #201F28;
}
#delmsgchat{    
    display: grid;
    align-items: center;
}
#delmsgchat > div{    
    cursor: pointer;
    width: 16px;
    height: 16px;
    margin: 2px;
}
</style>


<html>
    <div id=chat-block chat=>
        <div id=chat-block-con>
            <div id=close-chat>
                <div>Общий чат</div>
                <div id=btn-close><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="white" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
            </div>
            <div id=chat-window class=scrollstyle>
                <div id=msg-from-users>
                   <div id=msg-from-users-con><div id=txt-msg><a href=/id2 target=_blank>user</a><div>lala: lala</div></div><span id=date-msg>23:12</span></div><div id=delmsgchat><div id=delchatbtn><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"/>
</svg></div></div>
                </div>
                <div id=msg-from-me>
                   <div id=msg-from-me-con><div id=txt-msg><a href=/id4 target=_blank>user</a><div><img id=img-sticker src='https://chpic.su/_data/stickers/h/hasket_hentai/hasket_hentai_001.webp?v=1697990702'></div></div><span id=date-msg>23:12</span></div><div id=delmsgchat><div id=delchatbtn><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"/>
</svg></div></div>
                </div>
            </div>
            <div id=chat-btns>
                <div id=stickerbtn>
                   <div id=stickerblock>
                        <div id=stickers-cons class=scrollstyle>
                        </div>
                        <div id=typestickers>
                        </div>
                    </div>
                   <svg width="24" height="24" viewBox="0 0 124 124" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.97217 87.5324V36.8287C4.97217 19.3269 19.1602 5.13885 36.662 5.13885H87.3657C104.867 5.13885 119.055 19.3269 119.055 36.8287V87.5324C119.055 105.034 104.867 119.222 87.3657 119.222H36.662C19.1602 119.222 4.97217 105.034 4.97217 87.5324Z" stroke="white" stroke-width="9.50694"/>
<path d="M90.5346 78.0254C90.5346 78.0254 81.0277 90.7013 62.0138 90.7013C42.9999 90.7013 33.493 78.0254 33.493 78.0254" stroke="white" stroke-width="9.50694" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M39.831 49.5046C38.0808 49.5046 36.662 48.0858 36.662 46.3356C36.662 44.5854 38.0808 43.1666 39.831 43.1666C41.5811 43.1666 42.9999 44.5854 42.9999 46.3356C42.9999 48.0858 41.5811 49.5046 39.831 49.5046Z" fill="white" stroke="white" stroke-width="9.50694" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M84.1967 49.5046C82.4468 49.5046 81.0277 48.0858 81.0277 46.3356C81.0277 44.5854 82.4468 43.1666 84.1967 43.1666C85.9466 43.1666 87.3657 44.5854 87.3657 46.3356C87.3657 48.0858 85.9466 49.5046 84.1967 49.5046Z" fill="white" stroke="white" stroke-width="9.50694" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>
                <input id=msgtext type="text" placeholder='Написать сообщение в чат'>
                <input id=btn-msg type="button" value="Отправить">
            </div>
        </div>
        <div id=openchat>
            <svg width="20" height="20" viewBox="0 0 124 123" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4.97217 114.33V17.4259C4.97217 10.4251 10.6474 4.74994 17.6481 4.74994H106.38C113.38 4.74994 119.055 10.4251 119.055 17.4259V80.8055C119.055 87.8064 113.38 93.4814 106.38 93.4814H36.4164C32.5656 93.4814 28.9237 95.232 26.5181 98.2387L11.7444 116.706C9.4988 119.513 4.97217 117.925 4.97217 114.33Z" stroke="red" stroke-width="9.50694"/>
</svg>

        </div>
    </div>
    
    <script>
        $(document).on('click', '#btn-close', function  () {
            $("#chat-block-con").css('display','none');
            $("#chat-block").attr('chat','');
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
        
        function loadsticker(){
            let packs = [{'name':'','stickers':[]}];
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
            
            $('#stickers-cons').html('');
            $('#typestickers').html('');
            for (var i=0; i < packs.length; i++) {
                $('#typestickers').append('<div namepack='+packs[i].name+' id=stickercat>'+packs[i].name+'</div>');
                for (var f=0; f < packs[i].stickers.length; f++) {
                    $('#stickers-cons').append('<div idsticker='+packs[i].stickers[f].id+' id="sticker-con"><img id="img-sticker" src="http://'+window.location.host+packs[i].stickers[f].src+'"></div>');
                }
            }
                            
            
            
        }
        var stickerload = 0;
        var delmsg = '<div id=delmsgchat><div id=delchatbtn><svg width="16" height="16" viewBox="0 0 132 131" fill="none"xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"/></svg></div></div>';
        
        var admchat = ''; 
        if (infouser.admin==0){
            admchat = delmsg; 
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
                                loadsticker();
                            }
                            stickerload = 1;
                            if (data[0].data[i].delmsg == 0){
                                if ($('#chat-window')[0].scrollHeight-700 < $('#chat-window').scrollTop()){
                                     if (fload == 0) {
                                         scrollchat();
                                     }
                                } 
                                if (infouser.id == data[0].data[i].userid){
                                    var d = new Date(+data[0].data[i].datemsg * 1000);
                                    $('#chat-window').append('<div idmsg='+data[0].data[i].id+' class=msg_text id=msg-from-me><div id=msg-from-me-con><div id=txt-msg><a href=/id'+data[0].data[i].userid+' target=_blank>'+data[0].data[i].login+'</a><div>'+(data[0].data[i].attch=="sticker" ? "<img id=img-sticker src=http://"+window.location.host+get_sticker(data[0].data[i].typeattch)+">" : data[0].data[i].txtmsg)+'</div></div><span id=date-msg>'+d.getHours()+':'+d.getMinutes()+'</span></div>'+admchat+'</div>'); 
                                } else {
                                    var d = new Date(+data[0].data[i].datemsg * 1000);
                                    $('#chat-window').append('<div idmsg='+data[0].data[i].id+' class=msg_text id=msg-from-users><div id=msg-from-users-con><div id=txt-msg><a href=/id'+data[0].data[i].userid+' target=_blank>'+data[0].data[i].login+'</a><div>'+(data[0].data[i].attch=="sticker" ? "<img id=img-sticker src=http://"+window.location.host+get_sticker(data[0].data[i].typeattch)+">" : data[0].data[i].txtmsg)+'</div></div><span id=date-msg>'+d.getHours()+':'+d.getMinutes()+'</span></div>'+admchat+'</div>');
                                }   
                            }
                        }
                    }
                }
            });
        }
    </script>
</html>