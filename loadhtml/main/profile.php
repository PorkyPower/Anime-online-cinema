<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href="../css/main.css" type="text/css" rel="stylesheet"/>
    {{ MAIN.HEAD }}
</head>
<script>{{ USER.PROFILE }}</script>
<body>
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
                            <div>{{ PROFILE.ONLINE }}</div>
                        </div>
                    </div>
                    <div id=unbtns>
                        {{ PROFILE.BTNS }}
                    </div>
                </div>

            </div> 
        </div>
        
        <div id="prof-details">
            <div id=left-prof>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Профиль</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text>
                            <div id=left-foot-block-text>
                                <div>
                                    Ник: {{ PROFILE.INFONAME }}
                                </div>
                                <div>
                                    Имя: {{ PROFILE.NAMEUSER }}
                                </div>
                                <div>
                                    Дата рождения: {{ PROFILE.BIRTHDAY }}
                                </div>
                                <div>
                                    Город: {{ PROFILE.CITY }}
                                </div>
                            </div>
                            <div id=right-foot-block-text>
                                <div>
                                    Рейтинг: <a style=color:red;>{{ PROFILE.RATING }}</a>
                                </div>
                                <div>
                                    Ранг: <a style=color:lime;>{{ PROFILE.RANK }}</a>
                                </div>
                                <div>
                                    Последняя активность: {{ PROFILE.LASTONLINE }}
                                </div>
                                <div>
                                    {{ PROFILE.SUBSCRIBE }}
                                </div>
                                <div>
                                    Дата регистрации: {{ PROFILE.DATEREG }}
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            <div id=right-prof>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Друзья (<a class=ared id=showfriends>Все</a>)</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text>
                            <div id='fr_list'>
                                {{ FRIENDS.LIST }}
                            </div>
                        </div>
                    </div>
                </div>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Достижения</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text>
                            <div>
                                Нет достижений
                            </div>
                        </div>
                    </div>
                </div>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Рамки</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text>
                            <div>
                                Нет рамок
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
    
        $(document).on('click', '.delfriend', function  () {
            $.ajax({
                url: 'http://'+window.location.host+'/api/delfriend/'+infouser.token+'/'+infouser.idprof,
                method: 'GET',
                dataType: 'html',
                success: function(data){                   
                    $('.delfriend').html('Добавить в друзья');   
                    $('.delfriend').addClass('addfriend');                  
                    $('.addfriend').removeClass('delfriend');                  
                }
            });
        });
    
        $(document).on('click', '#showfriends', function  () {
            let mass_fr = '';
            border = '';
            for (i=0;i<Object.keys(friends_list).length;i++){
                if (friends_list[i].border != null){
                    border = '<div id=border_user style="background: url(http://SITE/imgs/users/borders/'+friends_list[i].border+');'+friends_list[i].border_pos+'"></div>';
                }
                mass_fr += '<a href=../id'+friends_list[i].id+' id=fr_block class=fr_block_list><div id="fr_sub"><div id="fr_ava" style="background: url(http://SITE/imgs/users/ava/'+friends_list[i].avatar+');background-size: cover;">'+border+'</div></div><div><div>'+friends_list[i].name+'</div><div>'+friends_list[i].activity+'</div></div></a>';
            }
            if (mass_fr == ''){
                mass_fr = '<div style="min-width: 400px;">Нет друзей</div>';
            }
            showpop('<div class=pop_list>'+mass_fr+'</div>',1,'Список друзей');
            console.log(friends_list[0].name);
        });
    
        $(document).on('click', '.addfriend', function  () {
            $.ajax({
                url: 'http://'+window.location.host+'/api/sendreqtofr/'+infouser.token+'/'+infouser.idprof,
                method: 'GET',
                dataType: 'html',
                success: function(data){               
                    if (infouser.type_friend == 'not friend'){
                        $('.addfriend').html('Отменить заявку');  
                    } else if (infouser.type_friend == 'request from user'){
                        $('.addfriend')[0].outerHTML = '';
                        $('.delfriend').html('Удалить из друзей');          
                    }
                    $('.addfriend').addClass('delfriend');                  
                    $('.delfriend').removeClass('addfriend');                  
                }
            });
        });
    
        $(document).on('click', '#menublock nav ul .menuchecked', function  () {
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
        });
</script>
</html>