<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href="../css/main.css" type="text/css" rel="stylesheet"/>
    <link href="../css/comms.css" type="text/css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/venom-player@latest"></script>
    {{ MAIN.HEAD }}
</head>
<script>{{ USER.PROFILE }}</script>

<body>
    <div id=mainplayer>
        {{ MAIN.TOPMENU }}
        <div id=watchbackgroundplayer>
            <div id=backgroundplayer>
            
            </div>
          <a id=copyright>Правообладателям</a>
        </div>
        
        
    </div>
    
    <div id=underplayer>
       {{ MAIN.SELECT.EPISODES }}
    </div>
    
    <div id=comms-block>
    <div id=cooms-count>Комментарии</div>
    <div>Написать комментарий</div>
    <div id=comms-form><div><input type="text" hidden id=reply_id_comm value=""><div id=inputtext placeholder='Напишите комментарий' contenteditable="true"></div></div><div><div id=sendcom><svg width="24" height="24" viewBox="0 0 124 106" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M119.055 52.785L4.97217 100.82L26.3628 52.785L4.97217 4.74994L119.055 52.785Z" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M25.9875 52.785H119.056" stroke="white" stroke-width="9.00658" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div></div></div>
    <div id=comms-list>

    </div>
</div>
    

    {{ MAIN.DOWNSITE }}
</body>
{{ MAIN.DOWNSCRIPT }}
<script>
    {{ SCRIPT.PROFILE }}
        $(document).on('click', '#menublock nav ul .menuchecked', function  () {
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
    
    $(function(){
        sendstatsf();
    });
    setInterval(() => sendstatsf(), 7000);
    
    function sendstatsf(){   

        if (curtime+30 > dur){
            curtime = dur;
        }
            $.ajax({
                url: 'http://'+window.location.host+'/api/stats', 
                method: 'POST',
                dataType: 'html',
                data: {path: location.pathname,
                         time: curtime,
                         dur: dur,
                        token: infouser.token},
                success: function(data){ 
                }
            });  
    }
    function typec(curtime){

    }
    $(document).on('click', '#copyright', function  () {
        showpop('<div style=max-width:600px;><div style="font-size: 14pt;">Для правообладателей</div><div style="font-size: 10pt;">Материал размещенный на сайте представлен исключительно для домашнего ознакомительного просмотра.</div><div style="font-size: 10pt;">Весь размещенный на сайте контент представляет собой материал, находящийся в свободном доступе для просмотра и скачивания в сети Интернет.</div><div style="font-size: 10pt;"></div><br><div style="font-size: 10pt;">Если Ваши исключительные права на объекты авторской собственности нарушаются каким-либо образом с использованием данного ресурса (размещение информации, защищенной авторским правом), администрация готова оказать Вам содействие и удалить с сайта соответствующие материалы.При возникновении спорных ситуаций мы просим Вас прислать нам письмо в электронном виде, где необходимо указать следующее:<br><br>1. Документальное подтверждение Ваших прав на материал, защищённый авторским правом:   <br><br>• отсканированный документ с печатью, либо   <br>• email с официального почтового домена компании правообладателя, либо   <br>• иная информация, позволяющая однозначно идентифицировать Вас как правообладателя данного материала.<br><br>2. Прямые ссылки на страницы сайта, которые содержат данные, опубликованные с нарушением авторских прав.</div></div>', 1);
    });
        
</script>
{{ MAIN.PLAYER }}
<script src="../js/dec/comments_dec.js"></script>

</html>