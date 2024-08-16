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
                                    <div>Показывать имя</div>
                                    <div>
                                        {{ PRIVACY.NAME }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Показывать дату рождения</div>
                                    <div>
                                        {{ PRIVACY.DATE }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Показывать город</div>
                                    <div>
                                        {{ PRIVACY.CITY }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Открытый профиль</div>
                                    <div>
                                        {{ PRIVACY.PROFILE }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div id=saveblockbtn>
                                        <a class=saveprofile id=buttonred>Сохранить</a>
                                        <div><div id=textsaved>сохранено</div></div>
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
                                    <a class=checkedlink  href=/privacy id=settingslink>Приватность</a>
                                </div>
                                <div>
                                    <a href=/social id=settingslink>Оповещания в соцсетях</a>
                                </div>
                                <div>
                                    <a id=settingslink  href=/subscribe>Подписка</a>
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
    
    
    
    
    
        $(document).on('click', '#menublock nav ul .menuchecked', function  () {
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
    


            $(document).click(function (e) { 
                if ($(e.target).closest("#btnuploadclose").length) {
                    if ($('#pop').attr('status')=='open'){
                        $('#pop').attr('status','');
                        $("#pop").fadeOut();
                    }
                return;
                } 
                
                if ($(e.target).closest("#upavatar").length) {
                    $("#textupload").html('Загрузить аватар (400х400, макс. размер 2мб)');
                    $('#pop').attr('status','open');
                    $('input[id=js-type]').attr('value','avatar');
                    $("#pop").fadeIn();
                return;
                }
                if ($(e.target).closest("#upbanner").length) {
                    $("#textupload").html('Загрузить обложку (1280х300, макс. размер 2мб)');
                    $('#pop').attr('status','open');
                    $('input[id=js-type]').attr('value','banner');
                    $("#pop").fadeIn();
                return;
                }
                
                if ($(e.target).closest("#pop").length) {
                return;
                }     
                
    
                if ($('#pop').attr('status')=='open'){
                    $('#pop').attr('status','');
                    $("#pop").fadeOut();
                }
            });


    
    
        $(document).on('click', '#delimageprofile', function  () {
            $(this).parent().children('input').attr('value','');
            if ($(this).parent().children('input').attr('name') == 'avatar'){
                $('#avatar').children().children().css({'background':'url(http://SITE/imgs/users/ava/default.jpg)','background-size': 'cover'});
            }
            if ($(this).parent().children('input').attr('name') == 'banner'){
                $('#imgback').css({'background':'url(http://SITE/imgs/users/banner/default.png)','background-size': 'cover', 'background-position':'center'});
            }
            $(this)[0].outerHTML = '';
        });
    
        $(document).on('click', '.saveprofile', function  () {
            adddataep = {
                token: infouser.token,
                id: '{{ PROFILE.ID }}',
                showname: $('select[name=showname]').val(),
                showdate: $('select[name=showdate]').val(),
                showcity: $('select[name=showcity]').val(),
                showprofile: $('select[name=showprofile]').val()
            };

            
            $.ajax({
                url: 'http://'+window.location.host+'/api/saveprofile', 
                method: 'POST',
                dataType: 'json',
                data: {sendadddata: JSON.stringify(adddataep)},
                success: function(data){ 
                    if (data.error){
                        $("#textsaved").html(data.error);
                        $("#textsaved").addClass('errmsg');
                        $("#textsaved").fadeIn('slow');
                    } else {
                        $("#textsaved").html('Сохранено');
                        $("#textsaved").removeClass('errmsg');
                        $("#textsaved").css('display', 'flex');
                        $("#textsaved").fadeOut('slow');  
                    }
                }
            });
            
        });
</script>
</html>