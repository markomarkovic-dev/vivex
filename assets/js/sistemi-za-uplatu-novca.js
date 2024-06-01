if(screen.width >= 991) {
    $('[data-feature]').mouseenter(function(){
        const thisData = $(this).data('feature');
        $(`[data-pointer=${thisData}]`).addClass('active')
    })
    
    $('[data-feature]').mouseleave(function(){
        const thisData = $(this).data('feature');
        $('.pointers span').removeClass('active')
    })
}