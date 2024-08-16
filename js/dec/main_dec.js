        var typepage = 1;
       function get_sort_content(scrolling = ''){
           var lis = document.querySelectorAll('.switch input[name=genre]:checked');
           var listcntr = document.querySelectorAll('.switch input[name=sortcounrt]:checked');

            var adddata = [];

            var ob = '';

            for (var i = 0; i < lis.length; i++) {
                ob = ob + lis[i].value + " ";
            }
            ob = ob.substring(0, ob.length - 1);
           
            var cntr = '';

            for (var i = 0; i < listcntr.length; i++) {
                cntr = cntr + listcntr[i].value + " ";
            }
            cntr = cntr.substring(0, cntr.length - 1);
           
            adddata = {
                token: infouser.token,
                genres: ob,
                year: range.noUiSlider.get(1)[0] + ' ' + range.noUiSlider.get(1)[1],
                rating: range2.noUiSlider.get(0)[0] + ' ' + range2.noUiSlider.get(0)[1],
                type: typepage,
                lastsort: $('input[name=lastsort]:checked').val(),
                counry: cntr
            };

            var blocks_mov = '';
            $.ajax({
                url: 'http://'+window.location.host+'/api/getcontent', 
                method: 'POST',
                dataType: 'json',
                data: adddata,
                success: function(data){ 
                    console.log(data);
                    var in_fav = '';
                    var in_view = '';
                    for (var i = 0; i < data.length; i++) {
                        if (data[i].favorite == 'true') {
                            in_fav = 'checkedbtn';
                        } else {
                            in_fav = '';
                        }
                        if (data[i].myview == 'true') {
                            in_view = 'checkedbtn';
                        } else {
                            in_view = '';
                        }
                        blocks_mov =  blocks_mov + "<div id=blockmovie>" +
                            "<div id=blockmovie-prev val="+data[i].link+"><img src=http://"+window.location.host+"/imgs/temp/"+data[i].prev+"></div>" +
                            "<div id=blockmovie-name>"+data[i].name+"</div>" +
                            "<div id=blockmovie-bottom><div id=blockmovie-bottom-left><div id=blockmovie-bottom-rating><svg width='28' height='28' viewBox='0 0 28 28' fill='orange' xmlns='http://www.w3.org/2000/svg'><path d='M16.0183 4.09496L18.0717 8.20162C18.3517 8.77329 19.0983 9.32162 19.7283 9.42662L23.45 10.045C25.83 10.4416 26.39 12.1683 24.675 13.8716L21.7817 16.765C21.2917 17.255 21.0233 18.2 21.175 18.8766L22.0033 22.4583C22.6567 25.2933 21.1517 26.39 18.6433 24.9083L15.155 22.8433C14.525 22.47 13.4867 22.47 12.845 22.8433L9.35668 24.9083C6.86002 26.39 5.34335 25.2816 5.99668 22.4583L6.82502 18.8766C6.97668 18.2 6.70835 17.255 6.21835 16.765L3.32502 13.8716C1.62168 12.1683 2.17002 10.4416 4.55002 10.045L8.27168 9.42662C8.89002 9.32162 9.63668 8.77329 9.91668 8.20162L11.97 4.09496C13.09 1.86662 14.91 1.86662 16.0183 4.09496Z' stroke='orange' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg>"+data[i].rating+"</div><div id=blockmovie-bottom-year>"+data[i].year+"</div></div><div id=blockmovie-btns><div idanime="+data[i].id+" class='favorite "+in_fav+"'><svg width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M11.5683 19.0758C11.2567 19.1858 10.7433 19.1858 10.4317 19.0758C7.77334 18.1683 1.83334 14.3825 1.83334 7.96584C1.83334 5.13334 4.11584 2.84167 6.93001 2.84167C8.59834 2.84167 10.0742 3.64834 11 4.89501C11.471 4.25873 12.0844 3.74159 12.7912 3.38502C13.4979 3.02846 14.2784 2.84237 15.07 2.84167C17.8842 2.84167 20.1667 5.13334 20.1667 7.96584C20.1667 14.3825 14.2267 18.1683 11.5683 19.0758Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg></div> <div idanime="+data[i].id+" class='view "+in_view+"'><svg width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'><path d='M14.2817 11.0001C14.2817 12.8151 12.815 14.2817 11 14.2817C9.185 14.2817 7.71834 12.8151 7.71834 11.0001C7.71834 9.18505 9.185 7.71838 11 7.71838C12.815 7.71838 14.2817 9.18505 14.2817 11.0001Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/><path d='M11 18.5809C14.2358 18.5809 17.2517 16.6742 19.3508 13.3742C20.1758 12.0817 20.1758 9.9092 19.3508 8.6167C17.2517 5.3167 14.2358 3.41003 11 3.41003C7.76416 3.41003 4.74833 5.3167 2.64916 8.6167C1.82416 9.9092 1.82416 12.0817 2.64916 13.3742C4.74833 16.6742 7.76416 18.5809 11 18.5809Z' stroke='white' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round'/></svg></div></div></div></div></div>";
                    }
                    $('#blocks-sort').html(blocks_mov); 
                    if (scrolling == 1){
                        const element = document.querySelector('#menuseries');
                        element.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            });
       }
        sortscript()
        function sortscript(){
            $( "input" ).on( "change", function() {
                $('.sortlast').children('span').html($('input[name=lastsort]:checked').parent().children('span').html());
                get_sort_content();
            });
            $(document).on('click', '#blockmovie-prev', function  () {
                var idanime = $(this).attr('val');
                window.location.pathname = idanime;
            });
            $(document).on('click', '#show-reset #show', function  () {
                get_sort_content();
            });
            $(document).on('click', '#show-reset #reset', function  () {
                get_sort_content();
            });
            $(document).on('click', '#show-reset-rating #show', function  () {
                get_sort_content();
            });
            $(document).on('click', '#show-reset-rating #reset', function  () {
                get_sort_content();
            });
        }
    
    
        $(function() {
            let geturl = document.location.href.split('#').pop();
            if (geturl == 'series'){
                $('#seriespage').trigger('click');
            } 
            else if (geturl == 'fullmovie'){
                $('#fullmoviepage').trigger('click');
            } 
            else if (geturl == 'favorite'){
                $('#favoritepage').trigger('click');
            } else {
                get_sort_content();
            }
        });