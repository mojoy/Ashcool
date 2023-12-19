

$(document).ready(function(){

    $(".gallery-icon > a").attr('data-fancybox','photo');
    $("[data-fancybox]").fancybox({
        loop     : true,
    });


    $('input,textarea').focus(function(){
        $(this).data('placeholder', $(this).attr('placeholder'))
        $(this).attr('placeholder', '');
    });

    $('input,textarea').blur(function(){
        $(this).attr('placeholder', $(this).data('placeholder'));
    });

    $(document).on('click', ".btn-menu", function(e){
        e.preventDefault();
        if ($('.btn-menu').hasClass('menu-nav-open')) {
            $('.btn-menu').removeClass('menu-nav-open');
            $('.row-nav').removeClass('row-nav-open');
        }
        else {
            $('.btn-menu').addClass('menu-nav-open');
            $('.row-nav').addClass('row-nav-open');
        }
        return false;
    });


});