<?php
include 'components/socials.php';
$copyLink = '';

if ($language == "ba") {
    $copyLink = "Kopiraj link";
} else if ($language == "en") {
    $copyLink = "Copy link";
} else if ($language == "rs") {
    $copyLink = "Копирај линк";
}
?>

<header class="header">
    <div class="header-container">
        <div class="header-left">
            <a href="<?= $siteUrl . '/' . $language. '/' . 'naslovna'?>">
            <img src="assets/images/logo-alternative.svg" class="logo" alt="">
            </a>
        </div>
        <div class="header-center">
            <nav>
                <a href="naslovna" class="nav-item <?= activePage('naslovna'); ?>"><?= $lang['global']['nav-home'] ?></a>
                <div href="proizvodi" class="nav-item nav-dropdown nav-categories<?= activePage('proizvodi'); ?>">
                    <a class="nav-item <?= activePage('o-nama'); ?>"><?= $lang['global']['nav-products'] ?></a>

                    <div class="dropdown">
                        <?php 
                            require 'components/product-categories.php';
                        ?>
                    </div>
                </div>
                <a href="reference" class="nav-item <?= activePage('reference'); ?>"><?= $lang['global']['nav-reference'] ?></a>
                <div class="nav-item nav-dropdown <?= activePage('o-nama'); ?>">
                    <a class="nav-item nav-about<?= activePage('o-nama'); ?>"><?= $lang['global']['nav-about'] ?></a>
                    <div class="dropdown">
                        <div class="submenu-items">
                            <a href="o-kompaniji" class="nav-item <?= activePage('o-kompaniji'); ?>"><?= $lang['global']['nav-about-company'] ?></a>
                            <a href="prodaja" class="nav-item <?= activePage('prodaja'); ?>"><?= $lang['global']['nav-sales'] ?></a>
                            <a href="proizvodnja" class="nav-item <?= activePage('proizvodnja'); ?>"><?= $lang['global']['nav-manufacturing'] ?></a>
                            <a href="servis" class="nav-item <?= activePage('servis'); ?>"><?= $lang['global']['nav-maintenance'] ?></a>
                        </div>
                    </div>
                </div>
                <a href="kontakt" class="nav-item <?= activePage('kontakt'); ?>"><?= $lang['global']['nav-contact'] ?></a>
            </nav>
            <div class="mobile-menu-footer">
                <?php 
                    include 'components/language-select.php';
                    socials("header");
                ?>
            </div>
        </div>
        <div class="header-right">
            <div class="nav-item nav-dropdown share-dropdown">
                <i class="fi fi-rs-share"></i>
                <div class="dropdown">
                    <div class="submenu-items">
                        <div class="slide-menu-body">
                            <div class="nav-item copy-link" data-link="<?= $siteUrl ?>"><i class="fi fi-rs-link-alt"></i> <?= $copyLink ?></div>
                            <a href="https://www.facebook.com/sharer.php?u=<?= $siteUrl ?>/&t=Home&v=3" target="_blank" class="nav-item "><img src="assets/icons/facebook.svg" alt=""> Facebook</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?= $siteUrl ?>&title=Home" target="_blank" class="nav-item  copy-link"><img src="assets/icons/linkedin.svg" alt=""> Linkedin</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                include 'components/language-select.php';
            ?>
            <i class="fi fi-rs-bars-staggered menu-switch"></i>
        </div>
    </div>
</header>