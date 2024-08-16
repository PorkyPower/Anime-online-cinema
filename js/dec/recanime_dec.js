        $(function(){
            var recanime = '';
            var numslide = 0;
            var procentslide = 0;
            
            $.ajax({
                url: 'http://'+window.location.host+'/api/recanime/'+infouser.token, 
                method: 'GET',
                dataType: 'json',
                success: function(data){ 
                    console.log(data);
                    recanime = data;
                    $('.watch').attr('idanime',recanime[numslide].link);
                    $('.btnicon.favorite').attr('idanime',recanime[numslide].id);
                        nameserie = 'Сезон <span class="clr_red fnt_w">'+recanime[numslide].se+'</span> - Серия <span class="clr_red fnt_w">'+recanime[numslide].ep+'</span> - '+recanime[numslide].nameep;
                    if (recanime[numslide].se == 0){
                        nameserie = recanime[numslide].origname;
                    }
                    $("#nameepisodeinfo").html('<span class="clr_orange fnt_16 fnt_w"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'+recanime[numslide].rating+'</span> '+nameserie+'');
                    $('#nameanimeinfo').html('<a href=/'+recanime[numslide].link+'>'+recanime[numslide].name+'</a>');
                    $('#descanimeinfo').html(recanime[numslide].description);  
                    
                        if (recanime[numslide].in_fav == 'yes'){
                            $('.btnicon.favorite').addClass('checkedbtn');
                        } else {
                            $('.btnicon.favorite').removeClass('checkedbtn');
                        }
                    
                    $('#imgbackgr').css({'background':'url(http://'+window.location.host+'/imgs/temp/'+recanime[numslide].banner+')','background-size':'cover'});
                    numslide = 1;
                }
            });
            
            
            let numtimer = setInterval(() => slide_procent(), 70);
            function slide_procent(){
                $('#ui-line-slider-wh').css('width', procentslide);
                procentslide +=0.5;
                if (procentslide >=60){
                    procentslide = 0;
                    if (numslide==1){
                        $('div[slide=one]').html('');
                        $('div[slide=two]').html('<div id=ui-line-slider-wh></div>');
                        $('div[slide=tree]').html('');
                        
                        $('.watch').attr('idanime',recanime[numslide].link);
                        $('.btnicon.favorite').attr('idanime',recanime[numslide].id);
                            nameserie = 'Сезон <span class="clr_red fnt_w">'+recanime[numslide].se+'</span> - Серия <span class="clr_red fnt_w">'+recanime[numslide].ep+'</span> - '+recanime[numslide].nameep;
                    if (recanime[numslide].se == 0){
                        nameserie = recanime[numslide].origname;
                    }
                    $("#nameepisodeinfo").html('<span class="clr_orange fnt_16 fnt_w"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'+recanime[numslide].rating+'</span> '+nameserie+'');
                        $('#nameanimeinfo').html('<a href=/'+recanime[numslide].link+'>'+recanime[numslide].name+'</a>');
                        $('#descanimeinfo').html(recanime[numslide].description);                    
                        if (recanime[numslide].in_fav == 'yes'){
                            $('.btnicon.favorite').addClass('checkedbtn');
                        } else {
                            $('.btnicon.favorite').removeClass('checkedbtn');
                        }
                        $('#imgbackgr').css({'background':'url(http://'+window.location.host+'/imgs/temp/'+recanime[numslide].banner+')','background-size':'cover'});
                        numslide = 2;
                    } else if (numslide==2) {
                        $('div[slide=one]').html('');
                        $('div[slide=two]').html('');
                        $('div[slide=tree]').html('<div id=ui-line-slider-wh></div>');
                        
                        $('.watch').attr('idanime',recanime[numslide].link);
                        $('.btnicon.favorite').attr('idanime',recanime[numslide].id);
                            nameserie = 'Сезон <span class="clr_red fnt_w">'+recanime[numslide].se+'</span> - Серия <span class="clr_red fnt_w">'+recanime[numslide].ep+'</span> - '+recanime[numslide].nameep;
                    if (recanime[numslide].se == 0){
                        nameserie = recanime[numslide].origname;
                    }
                    $("#nameepisodeinfo").html('<span class="clr_orange fnt_16 fnt_w"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'+recanime[numslide].rating+'</span> '+nameserie+'');
                        $('#nameanimeinfo').html('<a href=/'+recanime[numslide].link+'>'+recanime[numslide].name+'</a>');
                        $('#descanimeinfo').html(recanime[numslide].description);                    
                        if (recanime[numslide].in_fav == 'yes'){
                            $('.btnicon.favorite').addClass('checkedbtn');
                        } else {
                            $('.btnicon.favorite').removeClass('checkedbtn');
                        } $('#imgbackgr').css({'background':'url(http://'+window.location.host+'/imgs/temp/'+recanime[numslide].banner+')','background-size':'cover'});
                        
                        numslide = 0;
                    } else if(numslide==0) {
                        $('div[slide=one]').html('<div id=ui-line-slider-wh></div>');
                        $('div[slide=two]').html('');
                        $('div[slide=tree]').html('');  
                        
                        $('.watch').attr('idanime',recanime[numslide].link);
                        $('.btnicon.favorite').attr('idanime',recanime[numslide].id);
                            nameserie = 'Сезон <span class="clr_red fnt_w">'+recanime[numslide].se+'</span> - Серия <span class="clr_red fnt_w">'+recanime[numslide].ep+'</span> - '+recanime[numslide].nameep;
                    if (recanime[numslide].se == 0){
                        nameserie = recanime[numslide].origname;
                    }
                    $("#nameepisodeinfo").html('<span class="clr_orange fnt_16 fnt_w"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>'+recanime[numslide].rating+'</span> '+nameserie+'');
                        $('#nameanimeinfo').html('<a href=/'+recanime[numslide].link+'>'+recanime[numslide].name+'</a>');
                        $('#descanimeinfo').html(recanime[numslide].description);                    
                        if (recanime[numslide].in_fav == 'yes'){
                            $('.btnicon.favorite').addClass('checkedbtn');
                        } else {
                            $('.btnicon.favorite').removeClass('checkedbtn');
                        } $('#imgbackgr').css({'background':'url(http://'+window.location.host+'/imgs/temp/'+recanime[numslide].banner+')','background-size':'cover'});
                        numslide = 1;
                    }
                }
            }
           //let timer = setInterval(() => alert('tick'), 5000);
        });