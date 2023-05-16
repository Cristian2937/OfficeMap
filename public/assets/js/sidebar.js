$('.open-menu-btn').on('click', function(){
    if($('body').hasClass('closed-menu')){
        $('body').removeClass('closed-menu');
    }else  $('body').addClass('closed-menu');
});