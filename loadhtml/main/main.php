<html>
<head>
    <title>{{ MAIN.TITLE }}</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="./css/main.css" type="text/css" rel="stylesheet"/>
    {{ MAIN.HEAD }}
    
</head>
<script>{{ USER.PROFILE }}</script>
<body>
   
    <div id=mainblock>
        {{ MAIN.TOPMENU }}
        <div id=backgroundimage>
            <div id=imgbackgr style='background: url(http://SITE/imgs/temp/{{ ANIME.BANNER }});background-size: cover;background-position: top;width: 100%;height: 520px;'>
                <div id=ui-slider-block>
                    <div slide=one id=ui-line-slider><div id=ui-line-slider-wh></div></div>
                    <div slide=two id=ui-line-slider></div>
                    <div slide=tree id=ui-line-slider></div>
                </div>
            </div>
            <div id=blockinfoanime>
                <div id=nameepisodeinfo>
                    <div id="nameepisodeinfo">
                    <span class="clr_orange fnt_16 fnt_w"></span><span class="clr_red fnt_w"></span><span class="clr_red fnt_w"></span>
                </div>
                </div>
                <div id=nameanimeinfo>
                    
                </div>
                <div id=descanimeinfo>
                    
                </div>
                <div id=btnsinfo>
                    <div idanime=0 class='watch' id=buttonred><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M4 12V8.44C4 4.02 7.13 2.21 10.96 4.42L14.05 6.2L17.14 7.98C20.97 10.19 20.97 13.81 17.14 16.02L14.05 17.8L10.96 19.58C7.13 21.79 4 19.98 4 15.56V12Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
Смотреть</div>
                    <div class="btnicon favorite" id=button><svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
</div>                  
                </div>
            </div>

        </div>
        
        
    </div>
    <div id=seriesblock>
        <div id=menuseries>
            <nav>
                <ul>
                    <li><span class=menuchecked id=seriespage><a href='#series' id=seriespage><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.93998 19.9617H25.06M2.93998 8.29504H25.06M8.13165 19.9617V25.0367M14 19.9617V25.6317M19.7983 19.9617V25.1067M8.13165 2.46171V7.53671M14 2.46171V8.13171M14 8.20171V21.035M19.7983 2.46171V7.60671M25.6666 17.5V10.5C25.6666 4.66671 23.3333 2.33337 17.5 2.33337H10.5C4.66665 2.33337 2.33331 4.66671 2.33331 10.5V17.5C2.33331 23.3334 4.66665 25.6667 10.5 25.6667H17.5C23.3333 25.6667 25.6666 23.3334 25.6666 17.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
Серии</a><div id=spanchecked></div></span></li>
                    <li><span class="menuchecked hidecheck" id=fullmoviepage><a href='#fullmovie' id=fullmoviepage><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M2.93999 8.29504H25.06M9.94 2.46171V8.13171M18.06 2.46171V7.60671M25.6667 17.5V10.5C25.6667 4.66671 23.3333 2.33337 17.5 2.33337H10.5C4.66666 2.33337 2.33333 4.66671 2.33333 10.5V17.5C2.33333 23.3334 4.66666 25.6667 10.5 25.6667H17.5C23.3333 25.6667 25.6667 23.3334 25.6667 17.5Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.375 16.8584V15.4584C11.375 13.6617 12.6467 12.9267 14.1983 13.8251L15.4117 14.5251L16.625 15.2251C18.1767 16.1234 18.1767 17.5934 16.625 18.4917L15.4117 19.1917L14.1983 19.8917C12.6467 20.7901 11.375 20.0551 11.375 18.2584V16.8584Z" stroke="white" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
Полнометражные</a><div id=spanchecked></div></span></li>
                    <li><span class="menuchecked hidecheck" id=favoritepage><a href='#favorite' id=favoritepage><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
Мой список</a><div id=spanchecked></div></span></li>
                </ul>
            </nav>
        </div>
        <div id=polosarazdel></div>
        <div id=sort-series-genre>
            <div class=btn-un-sort-series-genre id=prev-un-sort-series-genre><</div>
            <div id=un-sort-series-genre>
                <div id="blocked_sort_genre"></div>
                <label class="switch ots1">
                  <input num="34" value="34" id="checkswitch" type="checkbox" name="genre" field="Боевик">
                  <span class="checksl">Боевик</span>
                </label>
                <label class="switch ots1">
                      <input num="40" value="40" id="checkswitch" type="checkbox" name="genre" field="Детектив">
                      <span class="checksl">Детектив</span>
                </label>
                <label class="switch ots1">
                      <input num="42" value="42" id="checkswitch" type="checkbox" name="genre" field="Драма">
                      <span class="checksl">Драма</span>
                </label>
                <label class="switch ots1">
                      <input num="50" value="50" id="checkswitch" type="checkbox" name="genre" field="Комедия">
                      <span class="checksl">Комедия</span>
                </label>
                <label class="switch ots1">
                      <input num="69" value="69" id="checkswitch" type="checkbox" name="genre" field="Приключения">
                      <span class="checksl">Приключения</span>
                </label>
                <label class="switch ots1">
                      <input num="73" value="73" id="checkswitch" type="checkbox" name="genre" field="Романтика">
                      <span class="checksl">Романтика</span>
                </label>
                 <label class="switch ots1">
                      <input num="84" value="84" id="checkswitch" type="checkbox" name="genre" field="Триллер">
                      <span class="checksl">Триллер</span>
                </label>
                <label class="switch ots1">
                      <input num="85" value="85" id="checkswitch" type="checkbox" name="genre" field="Ужасы">
                      <span class="checksl">Ужасы</span>
                </label>
                <label class="switch ots1">
                      <input num="86" value="86" id="checkswitch" type="checkbox" name="genre" field="Фантастика">
                      <span class="checksl">Фантастика</span>
                </label>
                <label class="switch ots1">
                      <input num="87" value="87" id="checkswitch" type="checkbox" name="genre" field="Фэнтези">
                      <span class="checksl">Фэнтези</span>
                </label>
                <label class="switch ots1">
                      <input num="90" value="90" id="checkswitch" type="checkbox" name="genre" field="Экшен">
                      <span class="checksl">Экшен</span>
                </label>
            </div>
            <div class=btn-un-sort-series-genre id=next-un-sort-series-genre>></div>
        </div>
        <div id=sort-group-select>
            <div id=sort-select>
                <div>Сортировать</div>
                <div>
                    <label class="switch sortfilter ots3">
                      <span class="checksl">По последним</span>
                    </label>
                    <div id="sort_modal">
                        <div>
                            <label class="switch ots3">
                                <input hidden checked value="last" id=checkswitch type="radio" name=lastsort>
                                <span class="radio_sort">По последним</span>
                            </label>
                        </div>
                        <div>
                            <label class="switch ots3">
                                <input hidden value="rating" id=checkswitch type="radio" name=lastsort>
                                <span class="radio_sort">По рейтингу</span>
                            </label>
                        </div>
                        <div>
                            <label class="switch ots3">
                                <input hidden value="year" id=checkswitch type="radio" name=lastsort>
                                <span class="radio_sort">По году выпуска</span>
                            </label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="switch sortfilter ots3">
                      <span class="checksl">Страны</span>
                    </label>
                    <div id="sort_modal" status="" style="display: none;">
                        <div>
                            <label class="switch ots3">
                                <input hidden  value="1" id="checkswitch" type="checkbox" name="sortcounrt">
                                <span class="radio_sort">Япония</span>
                            </label>
                        </div>
                        <div>
                            <label class="switch ots3">
                                <input hidden  value="2" id="checkswitch" type="checkbox" name="sortcounrt">
                                <span class="radio_sort">Китай</span>
                            </label>
                        </div>
                        
                    </div>
                </div>
                <div>
                    <label class="switch sortfilter ots3">
                      <span class="checksl">Год</span>
                    </label>
                    <div id="sort_modal" status="" style="display: none;">
                        <div>Год</div>
                        <div id=sort_slider_years>
                            <div id=slider_years_from>От</div>
                            <div id=slider_years_to>До</div>
                        </div>
                        <div id="range"></div>
                        <div id=show-reset>
                            <div id=show>Показать</div>
                            <div id=reset>Сбросить</div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="switch sortfilter ots3">
                      <span class="checksl">Рейтинг</span>
                    </label>
                    <div id="sort_modal" status="" style="display: none;">
                        <div>Рейтинг</div>
                        <div id=sort_slider_years>
                            <div id=slider_rating_from>От</div>
                            <div id=slider_rating_to>До</div>
                        </div>
                        <div id="range2"></div>
                        <div id=show-reset-rating>
                            <div id=show>Показать</div>
                            <div id=reset>Сбросить</div>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="switch fullgenres ots3">
                      <span class="checksl">Все жанры</span>
                    </label>
                    <div id="sort-fullgenres" status="" style="display: none;">
                        {{ MAIN.GENRE }}
                    </div>
                </div>
                <div>
                    <label class="switch resetfiltres ots3">
                      <span class="checksl">Сбросить фильтры</span>
                    </label>
                </div>

            </div>
        </div>
        <div id=blocks-sort>
            {{ MAIN.ANIME.SORT }}
        </div>
    </div>
    {{ MAIN.DOWNSITE }}


</body>

<script src="./js/dec/genreslide_dec.js"></script>
<script src="./js/dec/recanime_dec.js"></script>
<script src="./js/dec/slider_dec.js"></script>
<script src="./js/dec/btns_dec.js"></script>
<script src="./js/dec/menucont_dec.js"></script>
<script src="./js/dec/main_dec.js"></script>
{{ MAIN.DOWNSCRIPT }}
<script>
    {{ SCRIPT.PROFILE }}
    

</script>
<script>   
    
    
    $(document).click(function (e) { 
        if ($(e.target).closest('.sortfilter').length) {
            $('#sort_modal[status=open]').fadeOut('fast');
            $(e.target).parent().parent().children('#sort_modal').attr('status','open');
            $(e.target).parent().parent().children('#sort_modal').fadeIn('fast');
        return;
        }

        if ($(e.target).closest('#sort_modal').length) {
            return;
        }     
        $('#sort_modal[status=open]').fadeOut('fast');
        $('#sort_modal[status=open]').attr('status','');
    });    
    
    $(document).click(function (e) { 
        if ($(e.target).closest('.fullgenres').length) {
            $('#sort-fullgenres').attr('status','open');
            $('#sort-fullgenres').fadeIn('fast');
        return;
        }

        if ($(e.target).closest('#sort-fullgenres').length) {
            return;
        }     

        if ($('#sort-fullgenres').attr('status')=='open'){
            $('#sort-fullgenres').attr('status','');
            $('#sort-fullgenres').fadeOut('fast');
        }
    });
    
    
    $(document).on('click', '.resetfiltres', function(){
        console.log('reset');
        console.log();
        $('input[name=genre]:checked').prop('checked',false);
        $('input[name=sortcounrt]:checked').prop('checked',false);
        $('input[name=lastsort][value=last]').prop('checked',true);
        $( "#slider_years_from" ).html( "От " + years[0] );
        $( "#slider_years_to" ).html( "До " + years[1] );
        range.noUiSlider.set([years[0], years[1]]);
        $('#show-reset #show').fadeOut('slow');
        $( "#slider_rating_from" ).html( "От " + rating[0] );
        $( "#slider_rating_to" ).html( "До " + rating[1] );
        range2.noUiSlider.set([rating[0], rating[1]]);
        $('#show-reset-rating #show').fadeOut('slow');
        get_sort_content();
    });
    

    

</script>
</html>