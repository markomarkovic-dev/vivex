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
            <p class="section-subtitle"><?= $lang[$pagename]['page-heading']?></p>
        </div>
    </section>
    <section>
        <div class="section-container">
            <div class="device-replace-all">
                <div class="left-block">
                    <h2><?= $lang[$pagename]['one-replace-all']?></h2>
                    <div class="tag-list">
                        <?= $lang[$pagename]['one-replace-all-list']?>
                    </div>
                    <ul class="device-feature-list">
                        <?= $lang[$pagename]['device-feature-list']?>
                    </ul>
                </div>
                <div class="right-block">
                    <div class="img-background">
                        <img src="assets/images/vivex-sistemi-za-uplatu-novca-group.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-container">
            <div class="deposit-device-features">
                <div class="left-block">
                    <img src="assets/images/categories/vivex-sistemi-za-uplatu-novca.png" alt="">
                    <div class="pointers">
                        <span class="bar-code-1" data-pointer="bar-codes"></span>
                        <span class="bar-code-2" data-pointer="bar-codes"></span>
                        <span class="banknote-counter" data-pointer="banknote-counter"></span>
                        <span class="detection" data-pointer="detection"></span>
                        <span class="coin-counter-1" data-pointer="coin-counter"></span>
                        <span class="coin-counter-2" data-pointer="coin-counter"></span>
                        <span class="security-1" data-pointer="security"></span>
                        <span class="security-2" data-pointer="security"></span>
                        <span class="thermal-printer" data-pointer="thermal-printer"></span>
                        <span class="software" data-pointer="software"></span>
                    </div>
                </div>
                <div class="right-block">
                    <h2><?= $lang[$pagename]['finest-ingredients']?></h2>
                    <ul class="device-feature-list">
                        <?= $lang[$pagename]['finest-ingredients-list']?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-container deposit-video">
            <div class="text-block">
                <h2><?= $lang[$pagename]['new-way-cast-deposit']?></h2>
                <p><?= $lang[$pagename]['new-way-cast-deposit-desc']?></p>
            </div>
            <div class="video-block">
                <div class="video-iframe">
                    <iframe width="100%" height="325" src="https://www.youtube.com/embed/sOg0FpLUfqU" title="Cash Deposit system LIVIX 7" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-container additional-features">
            <div class="additional-feature">
                <i class="fi fi-rs-time-quarter-to"></i>
                <p><?= $lang[$pagename]['speed-deposit']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-users"></i>
                <p><?= $lang[$pagename]['reduces-retention']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-remove-user"></i>
                <p><?= $lang[$pagename]['reduces-engagement']?></p>
            </div>

            <div class="additional-feature">
                <i class="fi fi-rs-meeting"></i>
                <p><?= $lang[$pagename]['reduces-contact']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-triangle-warning"></i>
                <p><?= $lang[$pagename]['reduces-errors']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-marker"></i>
                <p><?= $lang[$pagename]['deposit-locations']?></p>
            </div>

            <div class="additional-feature">
                <i class="fi fi-rs-priority-arrows"></i>
                <p><?= $lang[$pagename]['fast-money']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-data-transfer"></i>
                <p><?= $lang[$pagename]['monitor-cash-flow']?></p>
            </div>
            <div class="additional-feature">
                <i class="fi fi-rs-piggy-bank"></i>
                <p><?= $lang[$pagename]['reduces-transport-costs']?></p>
            </div>
        </div>
    </section>
    <section>
        <div class="section-container customize-device">
            <div class="device-customize-text">
                <h2><?= $lang[$pagename]['customize-device']?></h2>
            </div>
        </div>
    </section>
</main>
<?php
include 'includes/global-footer.php';
?>
<script src="assets/js/sistemi-za-uplatu-novca.js"></script>