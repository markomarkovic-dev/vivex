$(document).ready(function($) {
    if ($('.accordion').hasClass('open')) {
        $('.accordion.open .accordion-body').css('display', 'block');
    }
})

$('.accordion-body').slideUp();
$('.accordion .accordion-title').click(function(){
    if($(this).parent().hasClass('open')) {
        $(this).parent().removeClass('open');
        $(this).next('.accordion-body').slideUp();
    } else {
        $(this).parent().addClass('open');
        $(this).next('.accordion-body').slideDown();
        $(this).parent().siblings().children('.accordion-body').slideUp();
        $(this).parent().siblings().removeClass('open');
    }
})
