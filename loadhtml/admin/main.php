<html>
<head>
    <title>Admin Panel - AnimeGan.Ru</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="./favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./css/admin.css" type="text/css" rel="stylesheet"/>
                    <script src="https://cdn.jsdelivr.net/npm/venom-player@latest"></script>
</head>
<script>
    {{ USER.INFO }}
</script>
<body>
    
    <div id=pop>
       <div class=btnupload id='btnuploadclose'>
           Закрыть
       </div>
        <label class="switch ots5">
            <form id="jsform" action="http://SITE/drag/upload.php">
                <div id="addimgbanner">
                    <div id='textupload'>Загрузить</div>
                    <input id="js-file" type="file" name="file">
                </div> 
            </form> 
        </label>
    </div>
    
    <div id=mainpage>
        <div id=leftblockmain>
            <div id=logo>
                <a id=button href='./'>AnimeGan</a>
            </div>
            <div id=menu>
                <div id=menup><a id="razdely">Разделы</a></div>
                <div id=menup><a id="kontent">Контент</a></div>
                <div id=menup><a id="genre">Жанры</a></div>
                <div id=menup><a id="komment">Комментарии</a></div>
                <div id=menup><a id="statistic"a>Статистика</a></div>
            </div>
        </div>
        <div id=backrightpanel>
            <div id=centerblockmain>
                <div id=texttopcenter>
                    Эй, ты! Вот админка
                </div>            
                   <div id=desctopcenter>
                    Тут можно добавлять новые аниме!
                </div>
                
                <div id=listanime>
 
                </div>            

            </div>
        </div>

    </div>
    
    <script>
        $(document).on('click', '.addcont', function  () {
            sendcont("add");
        });
        $(document).on('click', '.savecont', function  () {
            sendcont("save");
        });
        $(document).on('click', '.delcont', function  () {
            sendcont("del");
        });
        $(document).on('click', '.addtimecode', function  () {
            starttimecode = $(this).parent().children().children(".starttimecode").val();
            endtimecode = $(this).parent().children().children(".endtimecode").val();
            typetimecode = $('select[name=typetimecode]').val();
            $(this).parent().children().children(".starttimecode").val('0.0');
            $(this).parent().children().children(".endtimecode").val('0.0');
            
            $('#timecodes').append('<div id=timecodesec><div>От '+starttimecode+'</div><div>До '+endtimecode+'</div><div>'+typetimecode+'</div><div style=width:25px; class=deltimecode id="button">x</div><input hidden name=timecodes from='+starttimecode+' to='+endtimecode+' value='+typetimecode+'></div>');
        });
        $(document).on('click', '.deltimecode', function  () {
            $(this).parent()[0].outerHTML = '';
        });
        $(document).on('click', '.fromvideostart', function  () {
            $(this).parent().children('input').val(curtime);
        });
        $(document).on('click', '.fromvideoend', function  () {
            $(this).parent().children('input').val(curtime);
        });
        $(document).on('click', '.save_addcont', function  () {
            var list = document.querySelectorAll('input[name=timecodes]');

            var adddata = [];
            var ob = {};
            
            for (var i = 0; i < list.length; i++) {
                ob[i] = {
                    type: list[i].value,
                    start: list[i].getAttribute("from"),
                    end: list[i].getAttribute("to"),
                    skip: true,
                    title: ''
                };
            }

            adddata = {
                token: infouser.token,
                idanime: $('input[name=idanime]').val(),
                season: $('input[name=season]').val(),
                episode: $('input[name=episode]').val(),
                nameep: $('input[name=nameepisode]').val(),
                link: $('input[name=link]').val(),
                poster: $('input[name=poster]').val(),
                sections: ob,
                hide: $('select[name=type_addcont]').val(),
            };
            $.ajax({
                url: 'http://SITE/api/addepisode', 
                method: 'POST',
                dataType: 'html',
                data: {sendadddata: JSON.stringify(adddata)},
                success: function(data){ 
                    getpage('kontent');
                }
            });
            
            
        });
            function sendcont(typesend){           
            var lis = document.querySelectorAll('.switch input[value]:checked');

            var adddata = [];
            
            var ob = {};
            
            for (var i = 0; i < lis.length; i++) {
                ob[i] = {
                    idgenre: lis[i].value,
                    namegenre: lis[i].getAttribute("field")
                };
            }
            
            adddata = {
                token: infouser.token,
                id: typesend=="add" ? 0 : $(".savecont").attr("num"),
                banner: $('#addbannerimg').val(),
                prev: $('#addprevimg').val(),
                name: $('.namecont').val(),
                description: $('.desccont').val(),
                origname: $('.origname').val(),
                
                
                genre: ob,
                year: $('.yearcont').val(),
                watchyear: $('.watchyearcont').val(),
                link: $('.linkSpace').val(),
                type: $('.typecont').val(),
                status: $('.statuscont').val()
            };

            
            $.ajax({
                url: typesend=="add" ? 'http://SITE/api/addanmecontent' : typesend=="save" ? 'http://SITE/api/saveanmecontent' : 'http://SITE/api/delanmecontent', 
                method: 'POST',
                dataType: 'html',
                data: {sendadddata: JSON.stringify(adddata)},
                success: function(data){ 
                    getpage('razdely');
                }
            });
        }
        
        
        $(document).on('keyup', 'input[class="origname"]', function  () {
            var linkSpace = $(".origname").val();
            var linkOrig = linkSpace.replace(/ /g, "-");
            $(".linkSpace").val(linkOrig.toLowerCase());
        });
        function years(thisyear) {
            var options = "";
            for (let i = 2023; i >= 1990; i--) { // выведет 0, затем 1, затем 2
                if (i == thisyear){
                    options = options + "<option selected value="+i+">"+i+"</option>";
                } else {
                    options = options + "<option value="+i+">"+i+"</option>";
                }
            }
            $("#selectfield").html(options);
        }
        
        
        $(document).on('click', '.addanime', function  () {
            getpage('addanime');
        }); 
        $(document).on('click', '#razdely', function  () {
            getpage('razdely');
        });    
        $(document).on('click', '#kontent', function  () {
            getpage('kontent');
        });   
        $(document).on('click', '#genre', function  () {
            getpage('genre');
        });             
        $(document).on('click', '.genre', function  () {
            getpage('genre');
        });           
        $(document).on('click', '#blockcontent', function  () {
            addcont($(this).attr("val"));
        });          
        $(document).on('click', '#change_addcont', function  () {
            let addcont_idanime = $(this).attr('idanime');
            let addcont_season = $(this).attr('season');
            let addcont_episode = $(this).attr('episode');
            select_addcont_episode(addcont_idanime,addcont_season,addcont_episode);
        });          
        $(document).on('click', '.editrazdel', function  () {
            editrazdel($(this).attr("num"));
        });            
        
        $(document).on('click', '#checkswitch', function  () {
            $("#addgenre").html('<input class="ots addanimegenrevalue" id="inputtext" value=""><div class="saveanimegenre" id="button">Сохранить</div><div class="delanimegenre" id="button">Удалить</div><div class="genre" id="button">Отменить</div>');
            $(".addanimegenrevalue").val(this.value);
            $(".addanimegenrevalue").attr("num", $(this).attr("num"));
        });
        
        
        $(document).on('click', '.addanimegenre', function  () {
            if ($(".addanimegenrevalue").val()==""){
            } else {
                $.ajax({
                    url: 'http://SITE/api/addgenre', 
                    method: 'POST',
                    dataType: 'html',
                    data: {token: infouser.token,namegenre: $('.addanimegenrevalue').val()},
                    success: function(data){ 
                        getpage('genre');
                    }
                });
            }

        });  
        
        $(document).on('click', '.saveanimegenre', function  () {
            if ($(".addanimegenrevalue").val()==""){
            } else {
                $.ajax({
                    url: 'http://SITE/api/savegenre', 
                    method: 'POST',
                    dataType: 'html',
                    data: {token: infouser.token,
                        namegenre: $('.addanimegenrevalue').val(), 
                           idgenre: $('.addanimegenrevalue').attr("num")},
                    success: function(data){ 
                        getpage('genre');
                    }
                });
            }

        });  
        
        $(document).on('click', '.delanimegenre', function  () {
            $.ajax({
                url: 'http://SITE/api/delgenre', 
                method: 'POST',
                dataType: 'html',
                data: {token:infouser.token,idgenre: $('.addanimegenrevalue').attr("num")},
                success: function(data){ 
                    getpage('genre');
                }
            });
        });  
        
        var contentfull = null;
        function getfullcontent(){
            $.ajax({
                url: 'http://SITE/api/getfullcontent/0/'+infouser.token, 
                method: 'GET',
                dataType: 'json',
                success: function(data){ 
                    contentfull = data;
                    for (let i = 0; i < data.length; i++) {
                    var typecont = "";
                    var statuscont = "";
                    data[i].type==0 ? typecont = "Полнометражное" : typecont = "Серии";
                    data[i].status==0 ? statuscont = "Скрыто" : statuscont = "Опубликовано";
                    $('tbody[type=razd]').append('<tr><td><img id="previmg" src="http://SITE/imgs/temp/'+data[i].prev+'"></td><td><a id="prevname">'+data[i].name+'</a></td><td>'+data[i].description.substr(0,50)+'...</td><td>'+data[i].origname+'</td><td>'+data[i].year+'</td><td>'+data[i].rating+'</td><td>'+data[i].watchyear+'</td><td>'+data[i].link+'</td><td>'+typecont+'</td><td>'+statuscont+'</td><td><a num='+i+' class="editrazdel" id="button">Редактировать</a></td></tr>');
                    }
                }
            });
        }
        
        function getcontent_anime(){
            getfullcontent();
            $.ajax({
                url: 'http://SITE/api/getfullcontent/1/'+infouser.token, 
                method: 'GET',
                dataType: 'json',
                success: function(data){ 
                    $('#listanime').html('<div id=blockscont></div>');
                    for (let i = 0; i < data.length; i++) { 
                        $('#blockscont').append('<div id=blockcontent val='+i+'><img src=http://SITE/imgs/temp/'+data[i].prev+'><div>'+data[i].name+'</div><div id=yearsscontent><div>'+data[i].year+' Год</div><div id=sea_epi val='+data[i].id+'>'+data[i].se+' сезон '+data[i].ep+' серия</div></div></div>');
                    }
                }
            });
        }
        
        function editrazdel(idcont){
            $.ajax({
                url: 'http://SITE/adminpanel/addanime', 
                method: 'GET',
                dataType: 'html',
                success: function(data){ 
                    $("#listanime").html(data);
                    years(contentfull[idcont].year);
                    $(".namecont").val(contentfull[idcont].name);
                    $(".origname").val(contentfull[idcont].origname);
                    $(".linkSpace").val(contentfull[idcont].link);
                    $(".watchyearcont").val(contentfull[idcont].watchyear);
                    $(".statuscont").val(contentfull[idcont].status);
                    $(".typecont").val(contentfull[idcont].type);
                    $(".desccont").val(contentfull[idcont].description);
                    
                    $(".addcont").html("Сохранить");
                    $(".addcont").attr("num", contentfull[idcont].id);
                    $(".addcont").addClass("savecont");
                    $(".addcont").removeClass("addcont");
                    
                    $("#addbanner").html('<div style="width: 100%;background: url(http://SITE/imgs/temp/'+contentfull[idcont].banner+');height: 540px;background-size: cover;background-position: top;"></div><div type="banner" id="iconsbanner"><div class="addbtnupload">Удалить</div></div><input hidden="" value="'+contentfull[idcont].banner+'" id="addbannerimg">'); 
                    $("#addprev").html('<div style="width: 100%;background: url(http://SITE/imgs/temp/'+contentfull[idcont].prev+');height: inherit;background-size: cover;background-position-y: center;"></div><div type="prev" id="iconsbanner"><div class="addbtnupload">Удалить</div></div><input hidden="" value="'+contentfull[idcont].prev+'" id="addprevimg">');
                    
                    $('#hor').append('<div num='+contentfull[idcont].id+' class=delcont id="button">Удалить</div>');  
                    
                    for (let i = 0; i < contentfull[idcont].genre.length; i++) {
                        $("input[num="+contentfull[idcont].genre[i].idgenre+"]").prop("checked", true);
                    }
                }
            });
        }
        
        function addcont(idcont){
            $.ajax({
                url: 'http://SITE/adminpanel/addcont', 
                method: 'GET',
                dataType: 'html',
                success: function(data){ 
                    $("#listanime").html(data);
                    $("#addcont-name").html(contentfull[idcont].name);
                    $("input[name=idanime]").attr('value', contentfull[idcont].id);
                    load_addcont(contentfull[idcont].id);
                }
            }); 
        }
        
        function select_addcont_episode(addcont_idanime,addcont_season,addcont_episode){
            $.ajax({
                url: 'http://SITE/adminpanel/addcont_select_episode/'+addcont_idanime+'/'+addcont_season+'/'+addcont_episode, 
                method: 'GET',
                dataType: 'html',
                success: function(data){ 
                    $("#listanime").html(data);
                    load_select_addcont(addcont_idanime,addcont_season,addcont_episode);
                }
            }); 

        }
        function load_select_addcont(addcont_idanime,addcont_season,addcont_episode){
            $.ajax({
                url: 'http://SITE/api/getepisode/'+infouser.token+'/'+addcont_idanime+'/'+addcont_season+'/'+addcont_episode+'/1', 
                method: 'GET',
                dataType: 'json',
                success: function(data){ 
                    $('[name=nameepisode]').val(data.name);
                    $('[name=episode]').val(data.episode);
                    $('[name=season]').val(data.season);
                    $('[name=type_addcont]').val(data.hide);
                    $('[name=link]').val(data.link);
                    $('[name=idanime]').val(data.id_anime);
                    $('[name=poster]').val(data.poster);
                    $('.nameanime').html(data.animename);
                    if (data.sections != null){
                        for(i=0;i<data.sections.length;i++){
                            $('#timecodes').append('<div id="timecodesec"><div>От '+data.sections[i].start+'</div><div>До '+data.sections[i].end+'</div><div>'+data.sections[i].type+'</div><div style="width:25px;" class="deltimecode" id="button">x</div><input hidden name=timecodes from='+data.sections[i].start+' to='+data.sections[i].end+' value='+data.sections[i].type+'></div>');
                        }
                    }
                    
                    timeraaa(data.filename);

                }
            }); 
        }
        
        let timerpost = null;
        function timeraaa(wx){
            timerpost = setInterval(postinterval, 2000, wx);
        }
        delint = 0;
        function postinterval(filename){
            $.post('http://SITE/sys/getprogress.php',{namefile:filename}, function(datapost){
                if(datapost=='done'){
                    $('#lineprogress').attr('style','width:100%;');
                    clearInterval(timerpost);
                } else {
                    $('.upg').html('Обработка '+datapost+'%');
                    $('#lineprogress').attr('style','width:'+datapost+'%;');
                }
            });
        }
        
        
        function load_addcont(idcont){
            let anime_addcont = "";
            let anime_ses_addcont = "";
            
            $.ajax({
                url: 'http://SITE/api/getepisodes/'+infouser.token+'/'+idcont+'/0/s/1', 
                method: 'GET',
                dataType: 'json',
                success: function(data){ 
                    for (i=0;i<data.length;i++){
                        season_addcont = data[i].season;
                        for (f=0;f<data[i].items.length;f++){
                            episode_addcont = data[i].items[f].episode;
                            anime_addcont += "<a id=change_addcont idanime="+idcont+" season="+season_addcont+" episode="+episode_addcont+"><div style='background: black;min-width: 150px;height: 50px;border-radius: 15px;align-items: center;justify-content: center;overflow: hidden;'><div style='display: flex;justify-content: center;'><div style='position: absolute;align-items: center;height: 50px;display: flex;color:white;'>"+episode_addcont+" Серия</div></div></div></a>";
                        }
                        
                        anime_ses_addcont += "<div id=season_addcont>"+season_addcont+" сезон</div><div id=polosarazdel></div><div id=season_list_addcont>"+anime_addcont+"</div>";
                        anime_addcont = '';
                        
                    }
                    $('#addcont_table').html(anime_ses_addcont);
                }
            });
        }

        
        function getpage(typepage) {
            $.ajax({
                url: typepage=="addanime" ? 'http://SITE/adminpanel/addanime' : typepage=="razdely" ? 'http://SITE/adminpanel/getrazdel' : typepage=="kontent" ? 'http://SITE/adminpanel/getkontent' : typepage=="genre" ? 'http://SITE/adminpanel/getgenre' : "",
                method: 'GET',
                dataType: 'html',
                success: function(data){ 
                    $("#listanime").html(data);
                    if (typepage=="addanime"){
                        years();
                    } else if (typepage=="razdely"){
                        getfullcontent();
                    } else if (typepage == 'kontent'){
                        getcontent_anime();
                    }
                }
            });
        }
        
        
        
        $(document).on('click', '.addepisode', function  () {
            adddataep = {
                token: infouser.token,
                idanime: $('input[name=idanime]').val(),
                link: $('input[name=link]').val(),
                episode: $('input[name=episode]').val(),
                season: $('input[name=season]').val(),
                nameep: $('input[name=nameepisode]').val(),
                poster: $('input[name=poster]').val(),
            };

            
            $.ajax({
                url: 'http://SITE/api/addepisode', 
                method: 'POST',
                dataType: 'html',
                data: {sendadddata: JSON.stringify(adddataep)},
                success: function(data){ 
                    getpage('kontent');
                }
            });
        });  
        
    </script>
    
    

</body>
</html>