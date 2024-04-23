$('.popular-products').owlCarousel({
    loop: true,
    margin: 20,
    nav: true,
    items: 1,
    autoplay: true,
    autoplayTimeout: 5000,
    navText : ["<i class='fi fi-rs-angle-left'></i>","<i class='fi fi-rs-angle-right'></i>"],
    responsive : {
        768 : {
            items: 4,
            nav: true,
        }
    }
})