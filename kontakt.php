<?php 
    include 'includes/global-header.php';
?>

<main>
    <div class="cross-shapes contact-shapes">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small" alt="">
        <img src="assets/icons/logo-shape.svg" class="floating-img logo-shape" alt="">
        <img src="assets/icons/logo-shape-extra-small.svg" class="floating-img logo-shape-extra-small" alt="">
    </div>
    <section class="page-padding single-page">
        <div class="section-container">
            <h1 class="section-title-main"><?= $lang[$pagename]['title']?></h1>
                <p class="section-subtitle"><?= $lang[$pagename]['description']?></p>
        </div>
    </section>
    <section>
        <div class="section-container">
            <div class="static-tabs">
                <a href="https://vivex.rs/rs/kontakt" class="static-tab"><?= $lang[$pagename]['serbia']?></a>
                <div class="static-tab active"><?= $lang[$pagename]['bih']?></div>
            </div>
        </div>
    </section>
    <?= $lang['global']['contact-content']?>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>