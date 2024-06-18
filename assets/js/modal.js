$(document).ready(function() {
  $(".modal-open").on("click", function() {
    var dataAttribute = $(this).attr("data-trigger");
    var modal = $('.modal[data-modal="' + dataAttribute + '"]');
    modal.addClass("show");
    
    $("html").css("overflow", "hidden");

    if($(this).hasClass('modal-contact')) {
      $('#sendto').val($(this).data('contact'));
      console.log($(this).data('contact'))
    }
  });

  $(".modal-close").on("click", function() {
    var modal = $(this).closest(".modal");
    modal.removeClass("show");
    $("#contact-form").trigger("reset");

    $("html").css("overflow", "");
  });

  $('#sendto').change(function() {
    console.log($(this).val())
  })
});