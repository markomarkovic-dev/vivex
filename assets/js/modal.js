$(document).ready(function() {
  $(".modal-open").on("click", function() {
    var dataAttribute = $(this).attr("data-trigger");
    var modal = $('.modal[data-modal="' + dataAttribute + '"]');
    modal.addClass("show");
    
    $("html").css("overflow", "hidden");
  });

  $(".modal-close").on("click", function() {
    var modal = $(this).closest(".modal");
    modal.removeClass("show");

    $("html").css("overflow", "");
  });
});