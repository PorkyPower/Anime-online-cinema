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
                                    <div>Баланс</div>
                                    <div>
                                        {{ PROFILE.MONEY }} руб. (<a class="ared" href='#'>пополнить</a>)
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Подписка</div>
                                    <div>
                                        {{ PROFILE.SUBSCRIBE }}
                                    </div>
                                </div>
                                <div class='unfoot-block-text'>
                                    <div>Подписка до</div>
                                    <div>
                                        {{ PROFILE.SUBEND }}
                                    </div>
                                </div>
                                {{ SUBSCRIBE.TYPEBUY }}
                                {{ SUBSCRIBE.CHANGE }}
                                <div class='unfoot-block-text'>
                                    <div id=saveblockbtn>
                                        <a id=typessubs class="ared">Преимущества подписки</a>
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
                                    <a href=/social id=settingslink>Оповещания в соцсетях</a>
                                </div>
                                <div>
                                    <a class=checkedlink href=/subscribe id=settingslink>Подписка</a>
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


    
    
        $(document).on('click', '#typessubs', function  () {
            let tablesub= '<table><tr><th>Переимущества</th><th>Стандарт</th><th>Премиум</th></tr><tr><td>Цветной ник</td><td><a style=color:orange>Оранжевый</a></td><td><a style=color:red>Красный</a></td></tr><tr><td>Отсутствие рекламы</td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Рамки</td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Анимированные рамки</td><td><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Анимированный баннер</td><td><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Иконка подписки</td><td><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Совместный просмотр с друзьями</td><td><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr><tr><td>Стикеры в чате и комментариях</td><td><svg width="16" height="16" viewBox="0 0 132 131" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.97217 122.833L66.014 65.7919M66.014 65.7919L123.055 8.74994M66.014 65.7919L8.97217 8.74994M66.014 65.7919L123.055 122.833" stroke="red" stroke-width="16.3206" stroke-linecap="round" stroke-linejoin="round"></path></svg></td><td><svg width="16" height="12" viewBox="0 0 116 87" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.68356 50.7613L35.4991 80.5769L110.038 6.03797" stroke="lime" stroke-width="11.1808" stroke-linecap="round" stroke-linejoin="round"/></svg></td></tr></table>'
            showpop(tablesub,1);
        });
    
        $(document).on('click', '.subbtn', function  () {
            let apply = '';
            if ($(this).attr('changesub')){
                apply = '<div>Вы уверены?</div><br><div style=display:flex;><a class=subsend changesub="'+$(this).attr('changesub')+'" id=buttonred>Подтвердить</a><a class=closepop id=buttonred>Отмена</a></div>'; 
            } else {
                typesub = $(this).parent().attr('typesub');
                period = $(this).attr('period');
                apply = '<div>Вы уверены?</div><br><div style=display:flex;><a class=subsend typesub="'+typesub+'" period="'+period+'" id=buttonred>Подтвердить</a><a class=closepop id=buttonred>Отмена</a></div>'; 
            }
            showpop(apply,1);
        });
    
        $(document).on('click', '.subsend', function  () {
            if ($(this).attr('changesub')){
                adddataep = {
                    token: infouser.token,
                    changesub: $(this).attr('changesub'),
                };
            } else {
                adddataep = {
                    token: infouser.token,
                    typesub: $(this).attr('typesub'),
                    period: $(this).attr('period'),
                };
            }

            
            $.ajax({
                url: 'http://'+window.location.host+'/api/subscribe', 
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
            
        });
</script>
</html>