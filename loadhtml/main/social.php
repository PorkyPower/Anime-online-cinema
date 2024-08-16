<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href="../css/main.css" type="text/css" rel="stylesheet"/>
    <link href="../css/border.css" type="text/css" rel="stylesheet"/>
    <script src="http://SITE/dragprofile/script.js"></script>
    {{ MAIN.HEAD }}
</head>
<script>{{ USER.PROFILE }}</script>


<body>
   
       
    <div id=pop>
       <div class=btnupload id='btnuploadclose'>
           Закрыть
       </div>
        <label class="switch ots5">
            <form id="jsform" action="http://SITE/dragprofile/upload.php">
                <div id="addimgprof">
                    <div id='textupload'>Загрузить</div>
                    <input id="js-file" type="file" name="file">
                    <input id="js-type" type="text" name="type">
                </div> 
            </form> 
        </label>
    </div>
   
    <div id=mainprofile>
        {{ MAIN.TOPMENU }}
        
        
        <div id=blockprofile>
            <div id=background-profile-image>
                {{ PROFILE.IMAGE.BACK }}
                <div id='unprof'>
                    <div id=unimg>
                        <div id=avatar>
                            {{ PROFILE.IMAGE.AVATAR }}
                        </div> 
                        <div id=nameprofile>
                           <div>{{ PROFILE.NAME }}</div>
                            <div></div>
                        </div>
                    </div>
                    <div id=unbtns>
                        {{ PROFILE.BTNS }}
                    </div>
                </div>

            </div> 
        </div>
        
        <div id=prof-details>
            <div id=left-prof>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Настройки профиля</div>
                    </div>
                    <div id=foot-block-info>
                        <div class='colwr' id="foot-block-text">
                                <div class='unfoot-block-text'>
                                    <div>Оповещания ВК</div>
                                    <div style="display: flex;">
                                        {{ SOCIAL.VK }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Оповещания telegram</div>
                                    <div style="display: flex;">
                                        {{ SOCIAL.TG }}
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id=right-prof>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Разделы</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text >
                            <div id=gridfoot-block-text >
                                <div>
                                    <a id=settingslink href=/id{{ PROFILE.ID }}>Профиль</a>
                                </div>
                                <div>
                                    <a id=settingslink href=/editprofile>Основная информация</a>
                                </div>
                                <div>
                                    <a  href=/privacy id=settingslink>Приватность</a>
                                </div>
                                <div>
                                    <a class=checkedlink href=/social id=settingslink>Оповещания в соцсетях</a>
                                </div>
                                <div>
                                    <a href=/subscribe id=settingslink>Подписка</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
        
        
    </div>
    

    {{ MAIN.DOWNSITE }}
</body>
{{ MAIN.DOWNSCRIPT }}
<script>
    
    
{{ SCRIPT.PROFILE }}
    
        
        $(document).on('click', '.push_vk', function  () {
            push_social('vk');
            if ($(this).attr('id') == 'buttonred'){
                $(this).attr('id', 'button');
                $(this).html('Отключить');
            } else {
                $(this).attr('id', 'buttonred');
                $(this).html('Включить');
            }
        });
        $(document).on('click', '.push_tg', function  () {
            push_social('tg');
            if ($(this).attr('id') == 'buttonred'){
                $(this).attr('id', 'button');
                $(this).html('Отключить');
            } else {
                $(this).attr('id', 'buttonred');
                $(this).html('Включить');
            }
        });
    
    
        function push_social(soc) {
            
            adddataep = {
                token: infouser.token,
                social: soc,
            };

            
            $.ajax({
                url: 'http://'+window.location.host+'/api/push_social', 
                method: 'POST',
                dataType: 'json',
                data: {sendadddata: JSON.stringify(adddataep)},
                success: function(data){ 
                    console.log(data);
                    if (data == 'ok'){
                        location.reload();
                        return false;
                    }
                }
            });
            
        }
</script>
</html>