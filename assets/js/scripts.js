$(document).ready(function ($) {

  termsBanner();
  $('#accept-cookie').click(function () {
    window.localStorage.setItem('marketing', 'allow');
    $('.cookie-consent-banner').remove();
  });

  $('#decline-cookie').click(function () {
    window.localStorage.setItem('marketing', 'decline');
    $('.cookie-consent-banner').remove();
  });

  if(screen.width >= 992) {
    $('.nav-dropdown').hover(
      function() {
          
          $('.nav-dropdown').removeClass('open'); // Close all other dropdown content
          $(this).addClass('open'); // Add 'open' class on hover
      }
    );
  }

  if(screen.width <= 991) {
    console.log("manje od 991")
    $('.nav-dropdown').click(function(){
      if($(this).hasClass('open')) {
        $(this).removeClass('open');
      } else {
        $('.nav-dropdown').not($(this)).removeClass('open')
        $(this).addClass('open');
      }
    })
  }

});

$('.copy-link').click(function () {
  let thisLink = $(this).data('link');
  navigator.clipboard.writeText(thisLink);
});

$('div.copy-link').click(function () {
  if (document.documentElement.lang !== 'sr') {
    $(`<div class="copy-notif"><i class="ri-checkbox-circle-line"></i> Link copied</div>`).appendTo('body');
  } else {
    $(`<div class="copy-notif"><i class="ri-checkbox-circle-line"></i> Link kopiran</div>`).appendTo('body');
  }

  setTimeout(function () {
    $('.copy-notif').remove();
  }, 3100);
});

$('.menu-switch').click(function(){
  if($(this).hasClass('fi-rs-bars-staggered')) {
    $(this).removeClass('fi-rs-bars-staggered').addClass('fi-rs-cross');
    $('.header-center').addClass('show');
  } else {
    $(this).addClass('fi-rs-bars-staggered').removeClass('fi-rs-cross');
    $('.header-center').removeClass('show');
  }
})

function termsBanner() {
  const srAllow = `<div class="cookie-consent-banner">
      <div class="cookie-wrapper">
      <p>Da bismo pružili najbolje iskustvo, koristimo tehnologije poput kolačića za čuvanje i/ili pristup informacijama o uređaju. Saglasnost sa ovim tehnologijama će nam omogućiti da obrađujemo podatke kao što su ponašanje pri pregledanju ili jedinstveni ID-ovi na ovoj veb lokaciji. Nepristanak ili povlačenje saglasnosti može negativno uticati na određene karakteristike i funkcije.</p>
      <div class="btn-wrapper">
      <button class="btn btn-primary" id="accept-cookie">Prihvatam</button>
      <button class="btn btn-white" id="decline-cookie">Odbijam</button>
      </div>
      </div>
    </div>`;

  const enAllow = `<div class="cookie-consent-banner">
      <div class="cookie-wrapper">
      <p>To provide the best experiences, we use technologies like cookies to store and/or access device information. Consenting to these technologies will allow us to process data such as browsing behaviour or unique IDs on this site. Not consenting or withdrawing consent, may adversely affect certain features and functions.</p>
      <div class="btn-wrapper">
          <button class="btn btn-white" id="accept-cookie">Accept</button>
          <button class="btn btn-white" id="decline-cookie">Decline</button>
          </div>
      </div>
    </div>`;

    const deAllow = `<div class="cookie-consent-banner">
    <div class="cookie-wrapper">
    <p>Um die besten Erfahrungen zu bieten, verwenden wir Technologien wie Cookies, um Geräteinformationen zu speichern und/oder darauf zuzugreifen. Wenn Sie diesen Technologien zustimmen, ermöglichen Sie es uns, Daten wie das Surfverhalten oder eindeutige IDs auf dieser Website zu verarbeiten. Eine Nicht-Zustimmung oder der Widerruf der Zustimmung kann sich negativ auf bestimmte Funktionen und Eigenschaften auswirken.</p>
    <div class="btn-wrapper">
        <button class="btn btn-white" id="accept-cookie">Akzeptieren</button>
        <button class="btn btn-white" id="decline-cookie">Ablehnen</button>
        </div>
    </div>
  </div>`;


  if (window.localStorage.getItem('marketing') !== 'allow' && window.localStorage.getItem('marketing') !== 'decline') {
    if ($(document.documentElement.lang === 'sr')) {
      $(srAllow).appendTo('body');
    } else if($(document.documentElement.lang === 'en')) {
      $(enAllow).appendTo('body');
    } else if($(document.documentElement.lang === 'de')) {
      $(deAllow).appendTo('body');
    }
  }

      // Close dropdown when clicking outside
      $(document).click(function(e) {
        if (!$(e.target).closest('.nav-dropdown').length) {
            $('.nav-dropdown').removeClass('open');
            $('.dropdown').removeClass('show');
        }
    });
}

