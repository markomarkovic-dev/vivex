if(screen.width <= 991) {
    $('.product-column-left').clone().insertAfter('.product-column-right .product-header');
    $('.product-container > .product-column-left').remove();
}

$('.product-image-slider').owlCarousel({
    loop: true,
    nav: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    navText : ["<i class='fi fi-rs-angle-left'></i>","<i class='fi fi-rs-angle-right'></i>"],
})

$('.modal-quote').click(function(){
    $('.request-quote-text').addClass('active');
    $('.request-quote-text strong').text($('.product-name h1').text())
})

