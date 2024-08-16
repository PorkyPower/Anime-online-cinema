<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <link href="../css/main.css" type="text/css" rel="stylesheet"/>
    <link href="../css/support.css" type="text/css" rel="stylesheet"/>
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
                        <div id=head-block-text>{{ SUPPORT.NAMEPAGE }}</div>
                    </div>
                    <div id=foot-block-info>
                        <div class='colwr' id="foot-block-text">
                               {{ SUPPORT.PAGE }}
                               
                        </div>
                    </div>
                </div>
            </div>
            <div id=right-prof>
                <div id=block-info>
                    <div id=head-block-info>
                        <div id=head-block-text>Список обращений</div>
                    </div>
                    <div id=foot-block-info>
                        <div id=foot-block-text >
                            <div id=gridfoot-block-text >
                                {{ SUPPORT.QUETIONS }}
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
    

        $(document).on('click', '.sendquestion', function  () {
            adddataep = {
                token: infouser.token,
                section: $('select[name=section]').val(),
                theme: $('input[name=theme_support]').val(),
                msg: $('textarea[name=msg_support]').val(),
                hash: $('input[name=hash]').val(),
                dialog_msg: $('div[name=msg_sup]').html(),
            };
            
            $.ajax({
                url: 'http://'+window.location.host+'/api/support', 
                method: 'POST',
                dataType: 'json',
                data: {sendadddata: JSON.stringify(adddataep)},
                success: function(data){ 
                    console.log(data);
                    if (data.err){
                        showpop(data.err);
                    }
                    else if (data.success){
                        window.location.replace('../support/'+data.success);
                        return false;
                    } else {
                        $('div[name=msg_sup]').html('');
                        location.reload();
                    }
                }
            });
            
        });
    
        $('body').on('keydown',function(e) {
        if (e.keyCode == 13 && !e.shiftKey)
        {
            $('.sendquestion').trigger( "click" );
            $('div[name=msg_sup]').html('');
            return false;
        }
    });
</script>
</html>