<?php 
    include 'includes/global-header.php'; 
    $home = true;
    $apiUrl = "$backendUrl/wp-json/wp/v2/podesavanje-proizvod";

    $data = json_decode(file_get_contents($apiUrl), true);
    $post = $data[0];

    $popularProductArray =  $post['acf']['odaberi'];
    $popularProductId = implode(',', $popularProductArray) . ',';
    
    $apiUrlPopular = "$backendUrl/wp-json/wp/v2/proizvodi?_embed&acf_format=standard&include=$popularProductId";
    $dataPopular = json_decode(file_get_contents($apiUrlPopular), true);
?>

<main>
    <section class="landing">
        <div class="section-container">
            <h1><?= $lang[$pagename]['page-heading']?></h1>
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
                <a href="prodaja" class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/sales.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3><?= $lang['global']['nav-sales']?></h3>
                        <p><?= $lang[$pagename]['sales-desc']?></p>
                    </div>
                </a>
                <a href="proizvodnja" class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/manufacturing.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3><?= $lang['global']['nav-manufacturing']?></h3>
                        <p><?= $lang[$pagename]['manufacturing-desc']?></p>
                    </div>
                </a>
                <a href="servis" class="hero-block">
                    <div class="hero-block-icon">
                        <img src="assets/icons/maintenance.svg" alt="">
                    </div>
                    <div class="hero-block-text">
                        <h3><?= $lang['global']['nav-maintenance']?></h3>
                        <p><?= $lang[$pagename]['maintenance-desc']?></p>
                    </div>
                </a>
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
    <?php 
        require 'components/clients.php';
    ?>
    <section>
        <div class="section-container">
            <div class="featured-display">
                <div class="featured-block">
                    <div class="featured-block-image">
                        <img src="assets/images/vivex-sistemi-za-uplatu-novca.png" alt="">
                    </div>
                    <div class="featured-block-text">
                        <h4><?= $lang[$pagename]['new-deposit-way']?></h4>
                        <p><?= $lang[$pagename]['new-deposit-desc']?></p>
                        <a href="sistemi-za-uplatu-novca" class="btn btn-featured"><?= $lang['global']['find-more']?> <i class="fi fi-rs-arrow-right"></i></a>
                    </div>
                </div>
                <div class="featured-block">
                    <div class="featured-block-image">
                        <img src="assets/images/vivex-menjacnica.png" alt="">
                    </div>
                    <div class="featured-block-text">
                        <h4><?= $lang[$pagename]['fast-simple-currency']?></h4>
                        <p><?= $lang[$pagename]['fast-simple-currency-desc']?></p>
                        <a href="#" class="btn btn-featured"><?= $lang['global']['find-more']?> <i class="fi fi-rs-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="popular-section">
    <div class="section-container section-column">
            <h2 class="section-title"><?= $lang[$pagename]['popular-products']?></h2>
            <div class="owl-carousel popular-products">
                <?php 
                    foreach($dataPopular as $popular) {
                        $titleString = strip_tags($popular['title']['rendered']);
    
                        $unwantedElements = array("&nbsp;", "<br>", "<br/>", "<p>", "</p>", "<strong>", "</strong>", "[…]");
                        
                        //Očisti stringove od HTML tagova
                        $cleanedTitleString = str_replace($unwantedElements, "",  $titleString);
                        $postTitle = $cleanedTitleString;

                        $productImagePopular = $popular['acf']['photo_gallery']['galerija'][0][0]['full_image_url'];
                        $productCategoryPopular = $popular['_embedded']['wp:term'][0][0]['name'];

                        echo '<a href="proizvod?id='.$popular['slug'].'" class="product">
                                <img src="'.$productImagePopular.'" alt="">
                                <span class="product-category">'.$productCategoryPopular.'</span>
                                <h4 class="product-name">'.$postTitle.'</h4>
                            </a>';
                    }
                ?>
            </div>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/home.js"></script>