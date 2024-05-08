<?php 
    include 'includes/global-header.php';
    $apiUrl = "$backendUrl/wp-json/wp/v2/proizvodi";

    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    $requestUrl = $apiUrl . '?_embed&acf_format=standard&slug=' . $queries['id'];

    $data = json_decode(file_get_contents($requestUrl), true);
    $post = $data[0];

    $titleString = strip_tags($post['title']['rendered']);
    
    $unwantedElements = array("&nbsp;", "<br>", "<br/>", "<p>", "</p>", "<strong>", "</strong>", "[…]");
    
    //Očisti stringove od HTML tagova
    $cleanedTitleString = str_replace($unwantedElements, "",  $titleString);

    $postTitle = $cleanedTitleString;
    $acf = $post['acf'];
    $gallery = $acf['photo_gallery']['galerija'][0];
    $category_id = $post['categories'][0];
    $category_name = $lang['global']['category'][$category_id];

    //Povezani proizvodi
    $apiCatUrl = "$backendUrl/wp-json/wp/v2/proizvodi?category=$category_id";
    $catData = json_decode(file_get_contents($apiCatUrl), true);
    $productCount = 0;
?>

<main>
    <div class="cross-shapes product-shapes">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small" alt="">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small-2" alt="">
        <img src="assets/icons/logo-shape.svg" class="floating-img logo-shape-big" alt="">
        <img src="assets/icons/logo-shape-extra-small.svg" class="floating-img logo-shape-extra-small" alt="">
    </div>
    <section class="page-padding">
        <div class="section-container product-container">
            <div class="product-column-left">
                <div class="owl-carousel product-image-slider">
                    <?php 
                        foreach ($gallery as $galleryImage) {
                            echo '<img src="'.$galleryImage['full_image_url'].'" alt="">';
                        }
                    ?>
                </div>
                <div class="product-actions">
                    <button class="btn btn-secondary modal-open modal-quote" data-trigger="contact-form"><i class="fi fi-rs-document"></i>Request a quote</button>
                    <button class="btn btn-secondary"><i class="fi fi-rs-braille-d"></i>Compare</button>
                </div>
            </div>
            <div class="product-column-right">
                <div class="product-header">
                    <div class="product-name">
                        <span><?= $category_name?></span>
                        <h1><?= $postTitle?></h1>
                    </div>
                    <?php 
                        if($acf["dokument"] !== '') {
                            echo '<a href="'.$acf["dokument"].'" class="btn btn-white" download="download"><i class="fi fi-rs-file-download"></i>Download</a>';
                        }
                    ?>
                </div>
                <div class="product-attributes product-attributes-detailed">
                        <?php 
                            function attribute($name, $value) {
                                if ($value === '') {
                                    echo '<div class="attribute attribute-unavailable">
                                            <div class="attribute-description">
                                                <h5>'.$name.'</h5>
                                                <p>Nije dostupno</p>
                                            </div>
                                          </div>';
                                } else {
                                    echo '<div class="attribute attribute-available">
                                            <div class="attribute-description">
                                                <h5>'.$name.'</h5>
                                                <p>'.$value.'</p>
                                            </div>
                                        </div>';
                                }
                            }
                            isset($acf['prepoznavanje_denominacije']) ? attribute('Prepoznavanje denominacije:', $acf['prepoznavanje_denominacije']) : '';
                            isset($acf['dodatne_valute']) ? attribute('Dodatne valute:', $acf['dodatne_valute']) : '';
                            isset($acf['otkrivanje_krivotvorina']) ? attribute('Otkrivanje krivotvorina:', $acf['otkrivanje_krivotvorina']) : '';
                            isset($acf['dzep_za_odbijene_novcanice']) ? attribute('Džep za odbijene novčanice:', $acf['dzep_za_odbijene_novcanice']) : '';
                            isset($acf['skeniranje_serijskih_brojeva']) ? attribute('Skeniranje serijskih brojeva:', $acf['skeniranje_serijskih_brojeva']) : '';
                            isset($acf['sortiranje']) ? attribute('Sortiranje:', $acf['sortiranje']) : '';
                            isset($acf['mod_mesovitih_valuta']) ? attribute('Mod mješovitih valuta:', $acf['mod_mesovitih_valuta']) : '';
                            isset($acf['mod_mesovitih_valuta']) ? attribute('Portovi:', $acf['portovi']) : '';
                        ?>
                    </div>
                    <div class="main-attributes">
                        <div class="main-attribute">
                            <i class="fi fi-rs-tachometer-alt-fastest"></i>
                            <div class="main-attribute-text">
                                <span>Max. counting speed (note/min):</span>
                                <h4><?= $acf['maks_brzina_brojanja_notamin']?></h4>
                            </div>
                        </div>
                        <div class="main-attribute">
                            <i class="fi fi-rs-inbox"></i>
                            <div class="main-attribute-text">
                                <span>Kapacitet (lijevak / džep / odbijeno):</span>
                                <h4><?= $acf['kapacitet_lijevak__dzep__odbijeno']?></h4>
                            </div>
                        </div>
                        <div class="main-attribute">
                            <i class="fi fi-rs-ruler-triangle"></i>
                            <div class="main-attribute-text">
                                <span>Dimensions W / H / D (cm):</span>
                                <h4><?= $acf['dimenzije_svd_cm']?></h4>
                            </div>
                        </div>
                        <div class="main-attribute">
                            <i class="fi fi-rs-scale"></i>
                            <div class="main-attribute-text">
                                <span>Weight (kg):</span>
                                <h4><?= $acf['tezina_kg']?></h4>
                            </div>
                        </div>
                        <div class="main-attribute">
                            <i class="fi fi-rs-plug"></i>
                            <div class="main-attribute-text">
                                <span>Power supply:</span>
                                <h4><?= $acf['napajanje']?></h4>
                            </div>
                        </div>
                        <div class="main-attribute">
                            <i class="fi fi-rs-bolt"></i>
                            <div class="main-attribute-text">
                                <span>Power consumption:</span>
                                <h4><?= $acf['potrosnja_energije']?></h4>
                            </div>
                        </div>
                    </div>
                    <div class="additional-options">
                        <h5>Additional options:</h5>
                        <div class="additional-options-container">
                            <?php 
                                $additionalOptions = $post['acf']['dodatne_opcije'];
                                $additionalOptions = explode("\r\n", $additionalOptions);

                                foreach($additionalOptions as $option) {
                                    echo "<p>$option</p>";
                                }
                            ?>
                        </div>
                    </div>
            </div>
        </div>
        <div class="section-container category-container">
            <h3 class="section-title-main"><?= $category_name?></h3>
            <div class="related-category-products">
                <?php 
                    foreach($catData as $product) {
                        $productTitle = strip_tags($product['title']['rendered']);
                        $productImage = $product['acf']['photo_gallery']['galerija'][0][0]['thumbnail_image_url'];
                        
                        $productTitleClean = str_replace($unwantedElements, "",  $productTitle);
                        if ($productCount === 4) {
                            break;
                        } else {
                            echo '<a href="product?id='.$product['slug'].'" class="related-product">
                                    <img src="'.$productImage.'" alt="">
                                    <h5>'.$productTitleClean.'</h5>
                                </a>';
                                $productCount += 1;
                        }
                    }
                ?>
                <!-- <a href="#" class="related-product">
                    <img src="assets/images/categories/vivex-brojaci-kovanog-novca.png" alt="">
                    <h5>EAGLE EYE 7 VS</h5>
                </a>
                <a href="#" class="related-product">
                    <img src="assets/images/categories/vivex-brojaci-kovanog-novca.png" alt="">
                    <h5>EAGLE EYE 7 VS</h5>
                </a>
                <a href="#" class="related-product">
                    <img src="assets/images/categories/vivex-brojaci-kovanog-novca.png" alt="">
                    <h5>EAGLE EYE 7 VS</h5>
                </a>
                <a href="#" class="related-product">
                    <img src="assets/images/categories/vivex-brojaci-kovanog-novca.png" alt="">
                    <h5>EAGLE EYE 7 VS</h5>
                </a> -->
            </div>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/product.js"></script>
<script src="assets/js/gallery-modal.js"></script>