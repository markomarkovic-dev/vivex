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
    $('.product-name-select').removeClass('hidden');
})

$('.modal-open:not(.modal-quote)').click(function(){
    $('.product-name-select').addClass('hidden');
})
