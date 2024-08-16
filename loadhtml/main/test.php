
            $('#seriesblock').remove(); 
            
            $.ajax({
            url: 'http://SITE/api/getinfoanime/'+idanime, 
            method: 'GET',
            dataType: 'json',
            data: {},
            success: function(data){ 
                $("#nameepisodeinfo").html("<span class='clr_orange fnt_16 fnt_w'>"+data[0].rating+"</span>");
                $("#nameanimeinfo").html(data[0].name);
                $("#descanimeinfo").html(data[0].description);
            }
            });
            
            var ses = 1;
            var epi = 1;
            var html_content = '';
            var anime_series = '';
            var seasons = 1;
            var episodes = 1;
            $.ajax({
            url: 'http://SITE/api/getepisodes', 
            method: 'POST',
            dataType: 'json',
            data: {id_anime: idanime},
            success: function(data){ 
                //console.log(data[1][1]);
                for (key in data) {
                    for (je in data[key]) {
                            anime_series += "<label class='switch ots3'><a href='./"+idanime+"/s"+seasons+"_e"+episodes+"'><span class='checksl'>"+episodes+" Серия</span></a></label>";
                epi = episodes;
                        episodes +=1;
                    }
                html_content += "<div id=season>"+seasons+" сезон</div><div id=polosarazdel></div><div id=popular-genre>"+anime_series+"</div>";
                ses = seasons;
                anime_series = '';
                episodes = 1;
                seasons +=1;
                }
                
                $("#nameepisodeinfo").html($("#nameepisodeinfo").html()+' Сезон <span class="clr_red fnt_w">'+ses+'</span> - Серия <span class="clr_red fnt_w">'+epi+'</span> - '+data[ses][epi]['name']);
                
                $('#popularblock').html(html_content);
            }
                
            });