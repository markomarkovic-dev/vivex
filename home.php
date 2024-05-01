<?php 
    include 'includes/global-header.php'; 
    $home = true;
?>

<main>
    <section class="landing">
        <div class="section-container">
            <h1>The best <strong>systems</strong> and <strong>machines</strong> for <strong>working with money.</strong></h1>
        </div>
        <div class="cross-shapes">
            <img src="assets/icons/logo-shape.svg" class="floating-img logo-shape" alt="">
            <img src="assets/icons/logo-shape-big.svg" class="floating-img logo-shape-big" alt="">
            <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small" alt="">
        </div>
        <div class="animation-container">
            <img src="assets/images/counter2.png" class="floating-img counter-2" alt="">
            <img src="assets/images/suitcase2.png" class="floating-img suitcase-2" alt="">
            <img src="assets/images/lock.png" class="floating-img lock" alt="">
            <img src="assets/images/safe1.png" class="floating-img safe-1" alt="">
            <img src="assets/images/safe2.png" class="floating-img safe-2" alt="">
            <img src="assets/images/safe3.png" class="floating-img safe-3" alt="">
            <img src="assets/images/coin2.png" class="floating-img coin-1" alt="">
            <img src="assets/images/coin3.png" class="floating-img coin-2" alt="">
            <img src="assets/images/coin1.png" class="floating-img coin-3" alt="">
        </div>
    </section>
    <section class="section-pt-0">
        <div class="section-container">
            <div class="hero-blocks">
                <div class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/sales.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3>Prodaja</h3>
                        <p>Naš prodajni tim Vam stoji na raspolaganju kako bi pronašli najbolje rješenje za Vaše poslovanje.</p>
                    </div>
                </div>
                <div class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/manufacturing.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3>Proizvodnja</h3>
                        <p>Stvaranje sistema koji zadovoljavaju i najzahtjevnije korisnike.</p>
                    </div>
                </div>
                <div class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/maintainance.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3>Održavanje</h3>
                        <p>Profesionalno održavanje svih sistema i proizvoda iz našeg prodajnog asortimana.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="section-container product-categories">
            <?php 
                require 'components/product-categories.php';
            ?>
        </div>
    </section>
    <section class="client-section">
        <div class="section-container section-column">
            <h2 class="section-title">Neki od naših klijenata</h2>
            <div class="client-grid">
                <?php 
                    $clients = array(
                        "narodna-banka-srbije.svg",
                        "banca-intesa.svg",
                        "unicredit.svg",
                        "raiffeisen.svg",
                        "addiko-bank.svg",
                        "crowne-plaza.svg",
                        "delhaize.svg",
                        "nestle.svg",
                        "metro.svg",
                        "posta-crne-gore.svg",
                        "posta-srbije.svg",
                        "lukoil.svg",
                        "epcg.svg",
                        "eps.svg",
                        "zara.svg",
                        "mtel.svg",
                        "idea.svg",
                        "emmezeta.svg" 
                    );

                    foreach($clients as $client) {
                        $clientAlt = str_replace(".svg", "", $client);
                        $clientAlt = str_replace("-", " ", $clientAlt);
                        echo '<div class="client"><img src="assets/images/clients/'.$client.'" alt="'.$clientAlt.'"></div>';
                    }
                ?>
            </div>
            <p>...i mnogi drugi</p>
        </div>
    </section>
    <section>
        <div class="section-container">
            <div class="featured-display">
                <div class="featured-block">
                    <div class="featured-block-image">
                        <img src="assets/images/vivex-sistemi-za-uplatu-novca.png" alt="">
                    </div>
                    <div class="featured-block-text">
                        <h4>Novi način <strong>novčanog pologa</strong></h4>
                        <p>Skraćuje vrijeme između i dostupnosti na vašem računu.</p>
                        <a href="#" class="btn btn-featured">Saznaj više <i class="fi fi-rs-arrow-alt-right"></i></a>
                    </div>
                </div>
                <div class="featured-block">
                    <div class="featured-block-image">
                        <img src="assets/images/vivex-menjacnica.png" alt="">
                    </div>
                    <div class="featured-block-text">
                        <h4>Brza i jednostavna <strong>promjena valute</strong></h4>
                        <p>Skraćuje vrijeme između i dostupnosti na vašem računu.</p>
                        <a href="#" class="btn btn-featured">Saznaj više <i class="fi fi-rs-arrow-alt-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
    <div class="section-container section-column">
            <h2 class="section-title">Najpopularniji proizvodi</h2>
            <div class="owl-carousel popular-products">
                <a href="product" class="product">
                    <img src="assets/images/categories/vivex-automatska-menjacnica.png" alt="">
                    <span class="product-category">Banknote counter</span>
                    <h4 class="product-name">EAGLE EYE 7 VS</h4>
                </a>
                <a href="product" class="product">
                    <img src="assets/images/categories/vivex-automatska-menjacnica.png" alt="">
                    <span class="product-category">Banknote counter</span>
                    <h4 class="product-name">EAGLE EYE 7 VS</h4>
                </a>
                <a href="product" class="product">
                    <img src="assets/images/categories/vivex-automatska-menjacnica.png" alt="">
                    <span class="product-category">Banknote counter</span>
                    <h4 class="product-name">EAGLE EYE 7 VS</h4>
                </a>
                <a href="product" class="product">
                    <img src="assets/images/categories/vivex-automatska-menjacnica.png" alt="">
                    <span class="product-category">Banknote counter</span>
                    <h4 class="product-name">EAGLE EYE 7 VS</h4>
                </a>
            </div>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/home.js"></script>