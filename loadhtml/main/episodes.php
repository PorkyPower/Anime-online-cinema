<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    <link href="../css/comms.css" type="text/css" rel="stylesheet"/>
    {{ MAIN.HEAD }}
</head>
<script>{{ USER.PROFILE }}</script>

<body>
    <div id=mainblock>
        {{ MAIN.TOPMENU }}
        <div id=backgroundimage>
            <div style='background: url(http://SITE/imgs/temp/{{ ANIME.BANNER }});background-size: cover;background-position: top;width: 100%;height: 540px;'></div>
            <div id=blockinfoanime>
                <div id=nameepisodeinfo>
                    {{ ANIME.EPISODEINFO }}
                </div>
                <h1 id=nameanimeinfo>
                    {{ ANIME.NAME }}
                </h1>                
                <h2 id=orignameinfo>
                    {{ ANIME.ORIGNAME }}
                </h2>
                <h2 id=descanimeinfo>
                    {{ ANIME.DESC }}
                </h2>
                <div id=genresinfo>
                    {{ ANIME.GENRES }}
                </div>
                <div id=watchyearinfo>
                    {{ ANIME.WATCHYAER }}
                </div>
                <div id=btnsinfo>
                    <div class='watch' id=buttonred>
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 12V8.44C4 4.02 7.13 2.21 10.96 4.42L14.05 6.2L17.14 7.98C20.97 10.19 20.97 13.81 17.14 16.02L14.05 17.8L10.96 19.58C7.13 21.79 4 19.98 4 15.56V12Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Смотреть
                    </div>
                    <div class="btnicon favorite {{ ANIME.CHECKED }}" id=button><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>     
                </div>
            </div>
        </div>
        
        
    </div>
    
    <div id=popularblock>
       {{ MAIN.SEASONS.SERIES }}
    </div>

    {{ MAIN.DOWNSITE }}
</body>
{{ MAIN.DOWNSCRIPT }}
<script>
    
    {{ SCRIPT.PROFILE }}
    
        let continue_watch = '{{ ANIME.CONTINUE }}';
        $(function(){
            if (continue_watch == 's1_e1'){
                return;
            } else {
                if (continue_watch == 's0_e0'){
                    return;
                }
                $('.watch').html('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M4 12V8.44C4 4.02 7.13 2.21 10.96 4.42L14.05 6.2L17.14 7.98C20.97 10.19 20.97 13.81 17.14 16.02L14.05 17.8L10.96 19.58C7.13 21.79 4 19.98 4 15.56V12Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"></path></svg>Продолжить просмотр');
            }
        });
        $(document).on('click', '.watch', function  () {
            if (continue_watch == 's0_e0'){
                const el = document.querySelector('#watchbackgroundplayer');
                el.scrollIntoView({ behavior: 'smooth' });
                return;
            }
            window.location.pathname = window.location.pathname+'/'+continue_watch;
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
                    url: 'http://'+window.location.host+'/api/act_fav/'+infouser.token+'/'+act_val+'/'+infouser.id_anime, 
                    method: 'get',
                    dataType: 'html',
                    success: function(){ 
                        }
                });
            } else {
                showpop('Доступно только авторизованным');
            }
            
        });
    
        $(document).on('click', '#menublock nav ul .menuchecked', function  () {
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
        $(document).on('click', '#menupopular nav ul .menuchecked', function  () {
                $("#menupopular nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
        $(document).on('click', '#menuseries nav ul .menuchecked', function  () {
                $("#menuseries nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
        $(document).on('click', '#copyright', function  () {
            showpop('<div style=max-width:600px;><div style="font-size: 14pt;">Для правообладателей</div><div style="font-size: 10pt;">Материал размещенный на сайте представлен исключительно для домашнего ознакомительного просмотра.</div><div style="font-size: 10pt;">Весь размещенный на сайте контент представляет собой материал, находящийся в свободном доступе для просмотра и скачивания в сети Интернет.</div><div style="font-size: 10pt;"></div><br><div style="font-size: 10pt;">Если Ваши исключительные права на объекты авторской собственности нарушаются каким-либо образом с использованием данного ресурса (размещение информации, защищенной авторским правом), администрация готова оказать Вам содействие и удалить с сайта соответствующие материалы.При возникновении спорных ситуаций мы просим Вас прислать нам письмо в электронном виде, где необходимо указать следующее:<br><br>1. Документальное подтверждение Ваших прав на материал, защищённый авторским правом:   <br><br>• отсканированный документ с печатью, либо   <br>• email с официального почтового домена компании правообладателя, либо   <br>• иная информация, позволяющая однозначно идентифицировать Вас как правообладателя данного материала.<br><br>2. Прямые ссылки на страницы сайта, которые содержат данные, опубликованные с нарушением авторских прав.</div></div>', 1);
    });
</script>
</html>