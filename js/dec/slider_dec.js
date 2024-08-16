
const years = [1990,2024];
const rating = [0,10];



const rangeSliderInit = () => {
    const range = document.getElementById('range'); 
    const range2 = document.getElementById('range2'); 
    
    //if (!range || !inputMin || !inputMax) return 
    if (!range) return 


    noUiSlider.create(range, { 
      start: [years[0], years[1]],
      connect: true, 
      range: { 
        'min': years[0],
        'max': years[1]
      },
      step: 1, 
    }
    );
    noUiSlider.create(range2, { 
      start: [rating[0], rating[1]],
      connect: true, 
      range: { 
        'min': rating[0],
        'max': rating[1]
      },
      step: 0.1, 
    }
    );

    range.noUiSlider.on('update', function (values, handle) {
        $( "#slider_years_from" ).html( "От " + Math.round(values[0]) );
        $( "#slider_years_to" ).html( "До " + Math.round(values[1]) );
        $('#show-reset #show').fadeIn('slow');
    });
    range2.noUiSlider.on('update', function (values, handle) {
        $( "#slider_rating_from" ).html( "От " + Math.ceil(values[0]*10)/10 );
        $( "#slider_rating_to" ).html( "До " + Math.ceil(values[1]*10)/10 );
        $('#show-reset-rating #show').fadeIn('slow');
    });

  
}

const init = () => {
  rangeSliderInit() 
}
function loadslider(){
    init();
}
window.addEventListener('DOMContentLoaded', init) 

    $(document).on('click', '#show-reset #reset', function  () {
        $( "#slider_years_from" ).html( "От " + years[0] );
        $( "#slider_years_to" ).html( "До " + years[1] );
        range.noUiSlider.set([years[0], years[1]]);
        $('#show-reset #show').fadeOut('slow');
    });
    $(document).on('click', '#show-reset-rating #reset', function  () {
        $( "#slider_rating_from" ).html( "От " + rating[0] );
        $( "#slider_rating_to" ).html( "До " + rating[1] );
        range2.noUiSlider.set([rating[0], rating[1]]);
        $('#show-reset-rating #show').fadeOut('slow');
    });