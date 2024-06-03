<?php 
    include 'includes/global-header.php';
?>

<main>
    <div class="cross-shapes page-shapes">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small" alt="">
        <img src="assets/icons/logo-shape.svg" class="floating-img logo-shape" alt="">
        <img src="assets/icons/logo-shape-extra-small.svg" class="floating-img logo-shape-extra-small" alt="">
    </div>
    <section class="page-padding single-page">
        <div class="section-container">
            <div class="title-image">
                <h1 class="section-title-main"><?= $lang[$pagename]['title']?></h1>
                <?= $lang[$pagename]['page-subheading']?>
                <img src="assets/icons/logo-shape-alternative.svg" class="title-background" alt="">
            </div>
        </div>
    </section>
    <section>
        <div class="section-container company-history">
            <h2><?= $lang[$pagename]['key-points']?></h2>
            <div class="history-waterfall">
                <div class="time-point">
                    <div class="time-point-date">
                        <span>1995</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['foundation']?></h4>
                        <p><?= $lang[$pagename]['foundation-desc']?></p>
                    </div>
                </div>
                <div class="time-point">
                    <div class="time-point-date">
                        <span>1999</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['expansion']?></h4>
                        <p><?= $lang[$pagename]['expansion-desc']?></p>
                    </div>
                </div>
                <div class="time-point">
                    <div class="time-point-date">
                        <span>2003</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['expanding-services']?></h4>
                        <p><?= $lang[$pagename]['expanding-services-desc']?></p>
                    </div>
                </div>
                <div class="time-point">
                    <div class="time-point-date">
                        <span>2012</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['own-products']?></h4>
                        <p><?= $lang[$pagename]['own-products-desc']?></p>
                    </div>
                </div>
                <div class="time-point">
                    <div class="time-point-date">
                        <span>2014</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['international']?></h4>
                        <p><?= $lang[$pagename]['international-desc']?></p>
                    </div>
                </div>
                <div class="time-point">
                    <div class="time-point-date">
                        <span>2016</span>
                    </div>
                    <div class="time-point-description">
                        <h4><?= $lang[$pagename]['production-center']?></h4>
                        <p><?= $lang[$pagename]['production-center-desc']?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>