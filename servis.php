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
                <p class="section-subtitle"><?= $lang[$pagename]['description']?></p>
                <img src="assets/icons/maintenance-bck.svg" class="title-background" alt="">
            </div>
            <div class="page-content-row">
                <div class="page-content-left">
                    <img src="assets/images/maintenance-man.png" alt="">
                </div>
                <div class="page-content-right">
                    <div class="steps-content">
                        <div class="step">
                            <h4 class="step-number">1</h4>
                            <div class="step-text">
                                <h3><?= $lang[$pagename]['list-1-heading']?></h3>
                                <?= $lang[$pagename]['list-1-desc']?>
                            </div>
                        </div>
                        <div class="step">
                            <h4 class="step-number">2</h4>
                            <div class="step-text">
                                <h3><?= $lang[$pagename]['list-2-heading']?></h3>
                                <?= $lang[$pagename]['list-2-desc']?>
                            </div>
                        </div>
                        <div class="step">
                            <h4 class="step-number">3</h4>
                            <div class="step-text">
                            <h3><?= $lang[$pagename]['list-3-heading']?></h3>
                            <?= $lang[$pagename]['list-3-desc']?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>