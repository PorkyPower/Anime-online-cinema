
        var sortseriesgenre = $("#sort-series-genre").html();
        var sortgroupselect = $("#sort-group-select").html();
        var blockssort = $("#blocks-sort").html();
        let mylist;
        let myhis;

        $(document).on('click', '#favoritepage', function  () {
            if (infouser.id){
                const element = document.querySelector('#menuseries');
                element.scrollIntoView({ behavior: 'smooth' });
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $("#menuseries nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
                $('span[id=favoritepage]').removeClass("hidecheck");
                $("#sort-series-genre").html('');
                $("#sort-group-select").html('');
                $('#blocks-sort').html('<div id="mylist-block"><div id="mylist-text">Смотрел (<a id=showallview class=ared>Показать все</a>)</div><div class="myview" id="mylist-content"></div>            </div><div id="mylist-block"><div id="mylist-text">Запланировано (<a id=showallfav class=ared>Показать все</a>)</div><div class="myfav" id="mylist-content"></div></div><div id="mylist-block"><div id="mylist-text">История (<a id=showallhis class=ared>Показать все</a>)</div><div class="myhis" id="mylist-content"></div></div>');       
                $.ajax({
                    url: 'http://'+window.location.host+'/api/my_list/'+infouser.token, 
                    method: 'GET',
                    dataType: 'json',
                    success: function(data){ 
                        console.log(data);
                        
                        myhis =  data[1].data;
                        mylist =  data[0].data;
                        $('.myview').html('');
                        $('.myfav').html('');
                        counfav = 0;
                        counview = 0;
                        for (var i = 0; i < data[0].data.length; i++) {
                            let fav = '';
                            let myvi = '';
                            if (data[0].data[i].myview == 'true'){
                                myvi = 'checkedbtn';
                            }
                            if (data[0].data[i].favorite == 'true'){
                                fav = 'checkedbtn';
                            }
                            if (data[0].data[i].myview == 'true'){
                                counview++;
                                if (counview < 6){
                                    $('.myview').append('<div id="blockmovie"><div id="blockmovie-prev" val="'+data[0].data[i].link+'"><img src="http://'+window.location.host+'/imgs/temp/'+data[0].data[i].prev+'"></div><div id="blockmovie-name">'+data[0].data[i].name+'</div><div id="blockmovie-bottom"><div id="blockmovie-bottom-left"><div id="blockmovie-bottom-rating"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'+data[0].data[i].rating+'</div><div id="blockmovie-bottom-year">'+data[0].data[i].year+'</div></div><div id="blockmovie-btns"><div idanime="'+data[0].data[i].id+'" class="favorite '+fav+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div><div idanime="'+data[0].data[i].id+'" class="view '+myvi+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.2817 11.0001C14.2817 12.8151 12.815 14.2817 11 14.2817C9.185 14.2817 7.71834 12.8151 7.71834 11.0001C7.71834 9.18505 9.185 7.71838 11 7.71838C12.815 7.71838 14.2817 9.18505 14.2817 11.0001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.5809C14.2358 18.5809 17.2517 16.6742 19.3508 13.3742C20.1758 12.0817 20.1758 9.9092 19.3508 8.6167C17.2517 5.3167 14.2358 3.41003 11 3.41003C7.76416 3.41003 4.74833 5.3167 2.64916 8.6167C1.82416 9.9092 1.82416 12.0817 2.64916 13.3742C4.74833 16.6742 7.76416 18.5809 11 18.5809Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div></div></div></div>');   
                                }
                            }
                            if (data[0].data[i].favorite == 'true'){
                                counfav++;
                                if (counfav <6){
                                    $('.myfav').append('<div id="blockmovie"><div id="blockmovie-prev" val="'+data[0].data[i].link+'"><img src="http://'+window.location.host+'/imgs/temp/'+data[0].data[i].prev+'"></div><div id="blockmovie-name">'+data[0].data[i].name+'</div><div id="blockmovie-bottom"><div id="blockmovie-bottom-left"><div id="blockmovie-bottom-rating"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'+data[0].data[i].rating+'</div><div id="blockmovie-bottom-year">'+data[0].data[i].year+'</div></div><div id="blockmovie-btns"><div idanime="'+data[0].data[i].id+'" class="favorite '+fav+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div><div idanime="'+data[0].data[i].id+'" class="view '+myvi+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.2817 11.0001C14.2817 12.8151 12.815 14.2817 11 14.2817C9.185 14.2817 7.71834 12.8151 7.71834 11.0001C7.71834 9.18505 9.185 7.71838 11 7.71838C12.815 7.71838 14.2817 9.18505 14.2817 11.0001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.5809C14.2358 18.5809 17.2517 16.6742 19.3508 13.3742C20.1758 12.0817 20.1758 9.9092 19.3508 8.6167C17.2517 5.3167 14.2358 3.41003 11 3.41003C7.76416 3.41003 4.74833 5.3167 2.64916 8.6167C1.82416 9.9092 1.82416 12.0817 2.64916 13.3742C4.74833 16.6742 7.76416 18.5809 11 18.5809Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div></div></div></div>');
                                    
                                }
                            }
                        }     
                        $('.myhis').html('');
                        counthis = 0;
                        for (var i = 0; i < data[1].data.length; i++) {
                            counthis++;
                            if (counthis < 6){
                                var prcnt = Math.round(data[1].data[i].time*100/data[1].data[i].duration);
                                if (data[1].data[i].season == 0){
                                    text_season = 'Полнометражка';
                                } else {
                                    text_season = 'Сезон '+data[1].data[i].season+' Серия '+data[1].data[i].episode;
                                }
                                $('.myhis').append('<a href="/'+data[1].data[i].link+'/s'+data[1].data[i].season+'_e'+data[1].data[i].episode+'" id="blockmovie"><div id="blockmovie-prev" val="'+data[1].data[i].link+'"><img style="border-radius:0;" src="'+data[1].data[i].poster+'"><div style="height: 3px;    background: red;width: '+prcnt+'%;"></div></div><div id="blockmovie-name">'+data[1].data[i].name+'</div><div id="blockmovie-bottom">'+text_season+'</div></a>');   

                            }
                        }

                        const element = document.querySelector('#menuseries');
                        element.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            } else {
                  $(document).ready(function() {
                    if (window.location.href.indexOf("#favorite") > -1) {
                        window.history.replaceState('data', 'tit', 'http://'+window.location.host);
                    }
                  });
                showpop('Доступно только авторизованным');
            }
        });
        
        $(document).on('click', '#showallview', function  () {
            listview = '';
            for (var i = 0; i < mylist.length; i++) {
                let myvi = '';
                let fav = '';
                if (mylist[i].myview == 'true'){
                    myvi = 'checkedbtn';
                }
                if (mylist[i].favorite == 'true'){
                    fav = 'checkedbtn';
                }
                if (mylist[i].myview == 'true'){
                    listview +='<div id="blockmovie"><div id="blockmovie-prev" val="'+mylist[i].link+'"><img src="http://'+window.location.host+'/imgs/temp/'+mylist[i].prev+'"></div><div id="blockmovie-name">'+mylist[i].name+'</div><div id="blockmovie-bottom"><div id="blockmovie-bottom-left"><div id="blockmovie-bottom-rating"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'+mylist[i].rating+'</div><div id="blockmovie-bottom-year">'+mylist[i].year+'</div></div><div id="blockmovie-btns"><div idanime="'+mylist[i].id+'" class="favorite '+fav+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div><div idanime="'+mylist[i].id+'" class="view '+myvi+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.2817 11.0001C14.2817 12.8151 12.815 14.2817 11 14.2817C9.185 14.2817 7.71834 12.8151 7.71834 11.0001C7.71834 9.18505 9.185 7.71838 11 7.71838C12.815 7.71838 14.2817 9.18505 14.2817 11.0001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.5809C14.2358 18.5809 17.2517 16.6742 19.3508 13.3742C20.1758 12.0817 20.1758 9.9092 19.3508 8.6167C17.2517 5.3167 14.2358 3.41003 11 3.41003C7.76416 3.41003 4.74833 5.3167 2.64916 8.6167C1.82416 9.9092 1.82416 12.0817 2.64916 13.3742C4.74833 16.6742 7.76416 18.5809 11 18.5809Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div></div></div></div>';   
                }
            }
            showpop('<div class="pop_list">'+listview+'</div>', 1,'Смотрел');
        });
        $(document).on('click', '#showallfav', function  () {
            listview = '';
            for (var i = 0; i < mylist.length; i++) {
                let myvi = '';
                let fav = '';
                if (mylist[i].myview == 'true'){
                    myvi = 'checkedbtn';
                }
                if (mylist[i].favorite == 'true'){
                    fav = 'checkedbtn';
                }
                if (mylist[i].favorite == 'true'){
                    listview +='<div id="blockmovie"><div id="blockmovie-prev" val="'+mylist[i].link+'"><img src="http://'+window.location.host+'/imgs/temp/'+mylist[i].prev+'"></div><div id="blockmovie-name">'+mylist[i].name+'</div><div id="blockmovie-bottom"><div id="blockmovie-bottom-left"><div id="blockmovie-bottom-rating"><svg width="28" height="28" viewBox="0 0 28 28" fill="orange" xmlns="http://www.w3.org/2000/svg"><path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="orange" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg>'+mylist[i].rating+'</div><div id="blockmovie-bottom-year">'+mylist[i].year+'</div></div><div id="blockmovie-btns"><div idanime="'+mylist[i].id+'" class="favorite '+fav+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div><div idanime="'+mylist[i].id+'" class="view '+myvi+'"><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.2817 11.0001C14.2817 12.8151 12.815 14.2817 11 14.2817C9.185 14.2817 7.71834 12.8151 7.71834 11.0001C7.71834 9.18505 9.185 7.71838 11 7.71838C12.815 7.71838 14.2817 9.18505 14.2817 11.0001Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path><path d="M11 18.5809C14.2358 18.5809 17.2517 16.6742 19.3508 13.3742C20.1758 12.0817 20.1758 9.9092 19.3508 8.6167C17.2517 5.3167 14.2358 3.41003 11 3.41003C7.76416 3.41003 4.74833 5.3167 2.64916 8.6167C1.82416 9.9092 1.82416 12.0817 2.64916 13.3742C4.74833 16.6742 7.76416 18.5809 11 18.5809Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></div></div></div></div>';   
                }
            }
            showpop('<div class="pop_list">'+listview+'</div>', 1,'Запланировано ');
        });
        $(document).on('click', '#showallhis', function  () {
            console.log(myhis);
            his_cont = '';
            for (var i = 0; i < myhis.length; i++) {
                    var prcnt = Math.round(myhis[i].time*100/myhis[i].duration);
                    if (myhis[i].season == 0){
                        text_season = 'Полнометражка';
                    } else {
                        text_season = 'Сезон '+myhis[i].season+' Серия '+myhis[i].episode;
                    }
                    his_cont += '<a href="/'+myhis[i].link+'/s'+myhis[i].season+'_e'+myhis[i].episode+'" id="blockmovie"><div id="blockmovie-prev" val="'+myhis[i].link+'"><img style="border-radius:0;" src="'+myhis[i].poster+'"><div style="height: 3px;    background: red;width: '+prcnt+'%;"></div></div><div id="blockmovie-name">'+myhis[i].name+'</div><div id="blockmovie-bottom">'+text_season+'</div></a>';   

            }
            
            showpop('<div class="pop_list">'+his_cont+'</div>', 1,'История');
        });

        $(document).on('click', '#fullmoviepage', function  () {
                                
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $("#menuseries nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
                $("#sort-series-genre").html(sortseriesgenre);
                $("#sort-group-select").html(sortgroupselect);
                $("#blocks-sort").html(blockssort);
                loadslider();
                sortscript();
                typepage = 0;
                get_sort_content(1);
                $('span[id=fullmoviepage]').removeClass("hidecheck");
        });
        $(document).on('click', '#seriespage', function  () {
                $("#menublock nav ul span[class=menuchecked]").addClass("hidecheck");
                $("#menuseries nav ul span[class=menuchecked]").addClass("hidecheck");
                $(this).removeClass("hidecheck");
                $("#sort-series-genre").html(sortseriesgenre);
                $("#sort-group-select").html(sortgroupselect);
                $("#blocks-sort").html(blockssort);
                loadslider();
                sortscript();
                typepage = 1;
                get_sort_content(1);
                $('span[id=seriespage]').removeClass("hidecheck");
        });        