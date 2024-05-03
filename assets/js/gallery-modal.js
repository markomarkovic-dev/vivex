function galleryImage() {

  var galleryLinks = $('.owl-carousel img');
  var currentIndex;

  galleryLinks.click(function(event) {
    event.preventDefault();
    currentIndex = galleryLinks.index(this);

    openImageModal($(this).attr("src"));
  });

  function openImageModal(imageUrl) {
    var modal = $(
      `<div class="image-modal">
          <i class="fi fi-rs-cross image-close"></i>
          <div class="current-image">
            <img src="${imageUrl}"/>
          </div>
          <div class="next-prev-image">
            <div class="prev-image">
              <i class="fi fi-rs-angle-left"></i>
            </div>
            <div class="next-image">
              <i class="fi fi-rs-angle-right"></i>
            </div>
          </div>
      </div>`);

    $('body').append(modal);

    $('.prev-image').click(function(){
      showPrevImage();
    })

    $('.next-image').click(function(){
      showNextImage();
    })

    $('.image-close, .image-modal > img').click(function(){
      $(modal).remove();
    })
  }

  function showPrevImage() {
    currentIndex = (currentIndex - 1 + galleryLinks.length) % galleryLinks.length;
    var prevImageUrl = galleryLinks.eq(currentIndex).attr('src');
    $('.image-modal .current-image img').attr('src', prevImageUrl);
  }

  function showNextImage() {
    currentIndex = (currentIndex + 1) % galleryLinks.length;
    var nextImageUrl = galleryLinks.eq(currentIndex).attr('src');
    $('.image-modal .current-image img').attr('src', nextImageUrl);
  }
}

galleryImage();