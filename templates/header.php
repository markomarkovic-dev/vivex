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
            <img src="assets/images/logo-alternative.svg" class="logo" alt="">
        </div>
        <div class="header-center">
            <nav>
                <a href="home" class="nav-item <?= activePage('home'); ?>"><?= $lang['global']['nav-home'] ?></a>
                <div href="proizvodi" class="nav-item nav-dropdown nav-categories<?= activePage('proizvodi'); ?>">
                    <a class="nav-item <?= activePage('o-nama'); ?>"><?= $lang['global']['nav-products'] ?></a>

                    <div class="dropdown">
                        <div class="nav-product-categories">
                            <h3 class="section-title">Proizvodi</h3>
                            <div class="category-gallery">
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-sistemi-za-uplatu-novca.png" alt="">
                                    <span>Sistemi za uplatu novca</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-automatska-menjacnica.png" alt="">
                                    <span>Automatska mjenjačnica</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-pultne-blagajne.png" alt="">
                                    <span>Putne blagajne</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-brojaci-novca.png" alt="">
                                    <span>Brojači papirnog novca</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-brojaci-kovanog-novca.png" alt="">
                                    <span>Brojači kovanog novca</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-masine-za-obradu-novca.png" alt="">
                                    <span>Mašine za obradu novca</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-sefovi.png" alt="">
                                    <span>Sefovi</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-sigurnosna-oprema.png" alt="">
                                    <span>Sigurnosna oprema</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-masine-za-pakovanje.png" alt="">
                                    <span>Mašine za pakovanje</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-trezor.png" alt="">
                                    <span>Trezori</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-sigurnosni-koferi.png" alt="">
                                    <span>Sigurnosni koferi</span>
                                </a>
                                <a href="#" class="nav-category">
                                    <img src="assets/images/categories/vivex-softverska-resenja.png" alt="">
                                    <span>Softverska rešenja</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="reference" class="nav-item <?= activePage('reference'); ?>"><?= $lang['global']['nav-reference'] ?></a>
                <div class="nav-item nav-dropdown <?= activePage('o-nama'); ?>">
                    <a class="nav-item nav-about<?= activePage('o-nama'); ?>"><?= $lang['global']['nav-about'] ?></a>
                    <div class="dropdown">
                        <div class="submenu-items">
                            <a href="o-nama" class="nav-item <?= activePage('o-nama'); ?>"><?= $lang['global']['nav-about-company'] ?></a>
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