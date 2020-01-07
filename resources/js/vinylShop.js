export function hello(){
    console.log('The Vinyl Shop JavaScript works! 🙂');
}

export function to_mm_ss(duration) {
    let seconds = parseInt((duration / 1000) % 60);
    let minutes = parseInt((duration / (1000 * 60)) % 60);
    minutes = (minutes < 10) ? '0' + minutes : minutes;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    duration = minutes + ':' + seconds;
    return duration;
}

Noty.overrideDefaults({
    layout: 'topRight',
    theme: 'bootstrap-v4',
    timeout: 3000
});

$(function(){
    $('input[required], select[required], textarea[required]').each(function () {
        $(this).closest('.form-group')
            .find('label')
            .append('<sup class="text-danger mx-1">*</sup>');
    });

    $('nav i.fas').addClass('fa-fw mr-1');

    $('body').tooltip({
        selector: '[data-toggle="tooltip"]',
        html : true,
    });

    //basket
    $( "#dropdownMenuCart" ).click(function() {

        $('.basketcovers').each(function(){
            // Replace vinyl.png with real cover
            if( $(this).data('src')!= ''){
                $(this).attr('src', $(this).data('src'));
            }
        });

    });

});

let intervalId = new Map();
// wanneer windows is geladen
$(window).on('load', function() {


    // animation count

    //up
    $( ".animation-count-up" ).each(function( index ) {
        var thisObj = $(this);
        // change to min
        thisObj.text(thisObj.data('min'));

        //set to mapping structure and call animationcounter
        intervalId.set(thisObj, window.setInterval(animationCounter,thisObj.data("speed"),thisObj));

    });
});

//animation count up
function animationCounter(thisObj){
    if(thisObj.data('max') != thisObj.text()){
        thisObj.text(parseInt(thisObj.text())+1);
    }else{
        clearInterval(intervalId.get(thisObj));
    }

}