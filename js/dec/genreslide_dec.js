genreslide();
function genreslide(){
      $('#un-sort-series-genre').bind('mousewheel', function(e){ 
            $('#un-sort-series-genre').animate({
                scrollLeft: '+='+(e.originalEvent.wheelDelta * -2),
            }, 100);
            e.preventDefault();  
        });
    
        $(document).on('click', '#next-un-sort-series-genre', function  () {
            $('#un-sort-series-genre').animate({
                scrollLeft: '+=200',
            }, 200);
        });
        $(document).on('click', '#prev-un-sort-series-genre', function  () {
            $('#un-sort-series-genre').animate({
                scrollLeft: '-=200',
            }, 200);
        });


        let startPos = 0;
        let fixPos = 0;
        mclick = false;
        $(document).on('touchstart', '#un-sort-series-genre', function  (e) {
            startPos = e.touches[0].pageX;
            fixPos = $('#un-sort-series-genre').scrollLeft();
        });
        $(document).on('mousedown', '#un-sort-series-genre', function  (e) {
            startPos = e.pageX;
            fixPos = $('#un-sort-series-genre').scrollLeft();
            mclick = true;
        });
        $(document).on('mouseup', 'body', function  (e) {
            startPos = e.pageX;
            fixPos = $('#un-sort-series-genre').scrollLeft();
            mclick = false;
            $('#blocked_sort_genre').css('display','none');
        });

        document.getElementById('un-sort-series-genre').addEventListener('touchmove', function(e) {
            e.preventDefault();
            startX = e.changedTouches[0].pageX;
            posleft = startPos - startX;
            $('#un-sort-series-genre').scrollLeft(fixPos+posleft);
        });
        document.getElementById('un-sort-series-genre').addEventListener('mousemove', function(e) {
            if (mclick){
                $('#blocked_sort_genre').css('display','block');
                e.preventDefault();
                startX = e.pageX;
                posleft = startPos - startX;
                $('#un-sort-series-genre').scrollLeft(fixPos+posleft);
            }
        });
}

$(window).on('hashchange', function() {
genreslide();
});