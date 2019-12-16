$(function(){
    var dropdownBG = $('.dropdown-bg');
    $('.dropdown').hover(function(){
        $(this).children('.drop-menu').removeAttr('style');
        $(this).children('.drop-menu').css({
            'opacity': '1',
            'z-index': '9999'
        });
        dropdownBG.css({
            'opacity': '1',
            'z-index': '999'
        });
        dropdownBG.height($(this).children('.drop-menu').innerHeight());
    }, function(){
        $(this).children('.drop-menu').css({
            'opacity': '0',
            'z-index': '-1',
            'height':'0px'
    });
        dropdownBG.css({
            'opacity': '0',
            'z-index': '-1'
        });
    });

    $('#nav-item-bag').on('click', function(ev){
        ev.preventDefault();
        $('.bag').css('left','inherit');
    })
});