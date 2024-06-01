<?php 
    include 'includes/global-header.php';
    $product_page = true;
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
    $thisProductAcf = $post['acf'];
    $gallery = $thisProductAcf['photo_gallery']['galerija'][0];
    $category_id = $post['categories'][0];
    $category_name = $lang['global']['category'][$category_id]['title'];

    //Povezani proizvodi
    $thisProductId = $post['id'];
    $apiCatUrl = "$backendUrl/wp-json/wp/v2/proizvodi?categories=$category_id&exclude=$thisProductId";
    $catData = json_decode(file_get_contents($apiCatUrl), true);
    $productCount = 0;
    
    $compare = '';
    include 'components/product-attributes.php';
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
                    <button class="btn btn-secondary modal-open modal-quote" data-trigger="contact-form"><i class="fi fi-rs-document"></i>Zatražite ponudu</button>
                    <button class="btn btn-secondary modal-open" data-trigger="product-to-compare"><i class="fi fi-rs-braille-d"></i>Uporedite</button>
                </div>
            </div>
            <div class="product-column-right">
                <div class="product-header">
                    <div class="product-name">
                        <span><?= $category_name?></span>
                        <h1><?= $postTitle?></h1>
                    </div>
                    <?php 
                        if($thisProductAcf["dokument"] != '') {
                            echo '<a href="'.$thisProductAcf["dokument"].'" id="download-doc" class="btn btn-white" download="download"><i class="fi fi-rs-file-download"></i><span>Preuzmi</span></a>';
                        }
                    ?>
                </div>
                <div class="product-attributes product-attributes-detailed">
                <?php
                    attributes($thisProductAcf, 'mehanicka_brava', 'Mehanička brava:');
                    attributes($thisProductAcf, 'elektronska_brava', 'Elektronska brava:');
                    attributes($thisProductAcf, 'stepen_sigurnosti', 'Stepen sigurnosti:');
                    attributes($thisProductAcf, 'punjen_betonom_'.$language, 'Punjen betonom:');
                    attributes($thisProductAcf, 'zastita_od_busenja', 'Zaštita od bušenja:');
                    attributes($thisProductAcf, 'zastita_od_vatre', 'Zaštita od vatre:');
                    attributes($thisProductAcf, 'brava_sa_vremenom_zadrske', 'Brava sa vremenom zadrške:');
                    attributes($thisProductAcf, 'depozitni_otvor', 'Depozitni otvor:');
                    attributes($thisProductAcf, 'mogucnost_ankerisanja', 'Mogućnost ankerisanja:');
                    attributes($thisProductAcf, 'prepoznavanje_apoena_'.$language, 'Prepoznavanje apoena:');
                    attributes($thisProductAcf, 'dodatne_valute', 'Dodatne valute:');
                    attributes($thisProductAcf, 'detekcija_falsifikata', 'Detekcija falsifikata:');
                    attributes($thisProductAcf, 'dzep_za_odbacene_novcanice', 'Džep za odbačene novčanice:');
                    attributes($thisProductAcf, 'skeniranje_serijskih_brojeva_'.$language, 'Skeniranje serijskih brojeva:');
                    attributes($thisProductAcf, 'sortiranje_po_podobnosti', 'Sortiranje po podobnosti:');
                    attributes($thisProductAcf, 'mod_mesanih_valuta', 'Mod mešanih valuta:');
                    attributes($thisProductAcf, 'portovi', 'Portovi:');
                ?>
            </div>

            <div class="basic-attributes">
            <?php
                echo basicAttributes('Maks. brzina brojanja (novčanica/min):', isset($thisProductAcf['maks_brzina_brojanja_novcanicamin']) ? $thisProductAcf['maks_brzina_brojanja_novcanicamin'] : "", 'fi-rs-tachometer-alt-fastest');

                echo basicAttributes('Kapacitet (spremnik / obrađene / odbačene):', isset($thisProductAcf['kapacitet_spremnik_obradjene_odbacene']) ? $thisProductAcf['kapacitet_spremnik_obradjene_odbacene'] : "", 'fi-rs-inbox');

                echo basicAttributes('Dimenzije (Š/V/D) (cm):', isset($thisProductAcf['dimenzije_svd_cm']) ? $thisProductAcf['dimenzije_svd_cm'] : '', 'fi-rs-ruler-triangle');

                echo basicAttributes('Težina (kg):', isset($thisProductAcf['tezina_kg']) ? $thisProductAcf['tezina_kg'] : "", 'fi-rs-scale');

                echo basicAttributes('Napajanje:', isset($thisProductAcf['napajanje']) ? $thisProductAcf['napajanje'] : '', 'fi-rs-plug');

                echo basicAttributes('Potrošnja:', isset($thisProductAcf['potrosnja']) ? $thisProductAcf['potrosnja'] : '', 'fi-rs-bolt');
            ?>
            </div>
                <div class="additional-options">
                    <h5>Dodatne opcije:</h5>
                    <div class="additional-options-container">
                        <?php 
                            $additionalOptions = isset($thisProductAcf['dodatne_opcije_' . $language]) ? explode("\r\n", $thisProductAcf['dodatne_opcije_' . $language]) : array();
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

<div class="modal" data-modal="product-to-compare">
    <div class="modal-content modal-sm">
        <div class="modal-content-header">
            <h3 class="modal-title">Izaberi proizvod</h3>
            <i class="fi fi-rs-cross modal-close"></i>
        </div>
        <div class="modal-content-body">
            <div class="related-category-products">
                <?php 
                    foreach($catData as $product) {
                        $productTitle = strip_tags($product['title']['rendered']);
                        $productImage = $product['acf']['photo_gallery']['galerija'][0][0]['thumbnail_image_url'];
                        
                        $productTitleClean = str_replace($unwantedElements, "",  $productTitle);
                        echo '<a href="product?id='.$post['slug'].'&compareright=' . $product['id'] . '" class="related-product">
                            <img src="'.$productImage.'" alt="">
                            <h5>'.$productTitleClean.'</h5>
                        </a>';
                        }
                ?>
            </div>
        </div>
    </div>
</div>

<div class="modal <?= isset($_GET['compareright']) ? 'show' : '' ?>" data-modal="compare">
    <div class="modal-content modal-l">
        <div class="modal-content-header">
            <h3 class="modal-title">Uporedite proizvode:</h3>
            <i class="fi fi-rs-cross modal-close"></i>
        </div>
        <div class="modal-content-body">
            <div class="compare-container">
                <?php 
                    if(isset($_GET['compareright'])) {
                        $compare = 'show';
                        $requestCompareUrl = $apiUrl . '?_embed&acf_format=standard&orderby=include&include=' . $_GET['compareright'];
                        $compareData = json_decode(file_get_contents($requestCompareUrl), true);
                        $compareProduct = $compareData[0];
                        //ACF
                        $compareAcf = $compareProduct['acf'];

                        //Feature fotografija
                        $productImagecompare = $compareAcf['photo_gallery']['galerija'][0][0]['full_image_url'];

                        //Kategorija
                        $compareCategory_id = $compareProduct['categories'][0];
                        $category_name = $lang['global']['category'][$compareCategory_id]['title'];

                        //titl
                        $compareTitleString = strip_tags($compareProduct['title']['rendered']);
                        $cleanedCompareTitleString = str_replace($unwantedElements, "",  $compareTitleString);
                        $postCompareTitle = $cleanedCompareTitleString;

                        $additionalOptions = isset($thisProductAcf['dodatne_opcije_' . $language]) ? explode("\r\n", $thisProductAcf['dodatne_opcije_' . $language]) : array();
                        

                        ob_start();
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'mehanicka_brava', 'Mehanička brava:');
                        attributes($compareAcf, 'mehanicka_brava', 'Mehanička brava:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'elektronska_brava', 'Elektronska brava:');
                        attributes($compareAcf, 'elektronska_brava', 'Elektronska brava:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'stepen_sigurnosti', 'Stepen sigurnosti:');
                        attributes($compareAcf, 'stepen_sigurnosti', 'Stepen sigurnosti:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'punjen_betonom_'.$language, 'Punjen betonom:');
                        attributes($compareAcf, 'punjen_betonom_'.$language, 'Punjen betonom:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'zastita_od_busenja', 'Zaštita od bušenja:');
                        attributes($compareAcf, 'zastita_od_busenja', 'Zaštita od bušenja:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'zastita_od_vatre', 'Zaštita od vatre:');
                        attributes($compareAcf, 'zastita_od_vatre', 'Zaštita od vatre:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'brava_sa_vremenom_zadrske', 'Brava sa vremenom zadrške:');
                        attributes($compareAcf, 'brava_sa_vremenom_zadrske', 'Brava sa vremenom zadrške:');
                        
                        echo '</div>';

                        echo '<div class="attribute-group">';
                        
                        attributes($thisProductAcf, 'depozitni_otvor', 'Depozitni otvor:');
                        attributes($thisProductAcf, 'depozitni_otvor', 'Depozitni otvor:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'mogucnost_ankerisanja', 'Mogućnost ankerisanja:');
                        attributes($compareAcf, 'mogucnost_ankerisanja', 'Mogućnost ankerisanja:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'prepoznavanje_apoena_'.$language, 'Prepoznavanje apoena:');
                        attributes($compareAcf, 'prepoznavanje_apoena_'.$language, 'Prepoznavanje apoena:');
                        
                        echo '</div>';
                        echo '<div class="attribute-group">';
                    
                        attributes($thisProductAcf, 'dodatne_valute', 'Dodatne valute:');
                        attributes($compareAcf, 'dodatne_valute', 'Dodatne valute:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'detekcija_falsifikata', 'Detekcija falsifikata:');
                        attributes($compareAcf, 'detekcija_falsifikata', 'Detekcija falsifikata:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'dzep_za_odbacene_novcanice', 'Džep za odbačene novčanice:');
                        attributes($compareAcf, 'dzep_za_odbacene_novcanice', 'Džep za odbačene novčanice:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'skeniranje_serijskih_brojeva_'.$language, 'Skeniranje serijskih brojeva:');
                        attributes($compareAcf, 'skeniranje_serijskih_brojeva_'.$language, 'Skeniranje serijskih brojeva:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'sortiranje_po_podobnosti', 'Sortiranje po podobnosti:');
                        attributes($compareAcf, 'sortiranje_po_podobnosti', 'Sortiranje po podobnosti:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'mod_mesanih_valuta', 'Mod mešanih valuta:');
                        attributes($compareAcf, 'mod_mesanih_valuta', 'Mod mešanih valuta:');

                        echo '</div>';
                        echo '<div class="attribute-group">';

                        attributes($thisProductAcf, 'portovi', 'Portovi:');
                        attributes($compareAcf, 'portovi', 'Portovi:');

                        echo '</div>';
                        $attributes = ob_get_clean();

                        ob_start();
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Maks. brzina brojanja (novčanica/min):', isset($thisProductAcf['maks_brzina_brojanja_novcanicamin']) ? $thisProductAcf['maks_brzina_brojanja_novcanicamin'] : '', 'fi-rs-tachometer-alt-fastest');
                        echo basicAttributes('Maks. brzina brojanja (novčanica/min):', isset($compareAcf['maks_brzina_brojanja_novcanicamin']) ? $compareAcf['maks_brzina_brojanja_novcanicamin'] : '', 'fi-rs-tachometer-alt-fastest');
                        echo '</div>';
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Kapacitet (spremnik / obrađene / odbačene):', isset($thisProductAcf['kapacitet_spremnik_obradjene_odbacene']) ? $thisProductAcf['kapacitet_spremnik_obradjene_odbacene'] : '', 'fi-rs-inbox');
                        echo basicAttributes('Kapacitet (spremnik / obrađene / odbačene):', isset($compareAcf['kapacitet_spremnik_obradjene_odbacene']) ? $compareAcf['kapacitet_spremnik_obradjene_odbacene'] : '', 'fi-rs-inbox');
                        echo '</div>';
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Dimenzije (Š/V/D) (cm):', isset($thisProductAcf['dimenzije_svd_cm']) ? $thisProductAcf['dimenzije_svd_cm'] : '', 'fi-rs-ruler-triangle');
                        echo basicAttributes('Dimenzije (Š/V/D) (cm):', isset($compareAcf['dimenzije_svd_cm']) ? $compareAcf['dimenzije_svd_cm'] : '', 'fi-rs-ruler-triangle');
                        echo '</div>';
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Težina (kg):', isset($thisProductAcf['tezina_kg']) ? $thisProductAcf['tezina_kg'] : '', 'fi-rs-scale');
                        echo basicAttributes('Težina (kg):', isset($compareAcf['tezina_kg']) ? $compareAcf['tezina_kg'] : '', 'fi-rs-scale');
                        echo '</div>';
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Napajanje:', isset($thisProductAcf['napajanje']) ? $thisProductAcf['napajanje'] : '', 'fi-rs-plug');
                        echo basicAttributes('Napajanje:', isset($compareAcf['napajanje']) ? $compareAcf['napajanje'] : '', 'fi-rs-plug');
                        echo '</div>';
                        echo '<div class="basic-attributes-group">';
                        echo basicAttributes('Potrošnja:', isset($thisProductAcf['potrosnja']) ? $thisProductAcf['potrosnja'] : '', 'fi-rs-bolt');
                        echo basicAttributes('Potrošnja:', isset($compareAcf['potrosnja']) ? $compareAcf['potrosnja'] : '', 'fi-rs-bolt');
                        echo '</div>';
                        $basicAttributes = ob_get_clean();

                        echo '<div class="compare-column">
                                <div class="compare-feature-group">
                                    <div class="compare-feature-image">
                                        <img src="'.$gallery[0]['full_image_url'].'"/>
                                    </div>
                                    <div class="compare-feature-image">
                                        <img src="'.$productImagecompare.'"/>
                                    </div>
                                </div>
                                <div class="product-header-group">
                                    <div class="product-header">
                                        <div class="product-name">
                                            <span>'.$category_name.'</span>
                                            <h1>'.$postTitle.'</h1>
                                        </div>
                                    </div>
                                    <div class="product-header">
                                        <div class="product-name">
                                            <span>'.$category_name.'</span>
                                            <h1>'.$postCompareTitle.'</h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-attributes product-attributes-detailed">
                                    '.$attributes.'
                                </div>
                                <div class="basic-attributes">
                                    '.$basicAttributes.'
                                </div>
                                <div class="additional-options">
                                    
                                    <div class="additional-options-group">
                                        <div class="additional-options-container">';
                                            echo '<h5>Dodatne opcije:</h5>';
                                            $additionalOptionsLeft = isset($thisProductAcf['dodatne_opcije_' . $language]) ? explode("\r\n", $thisProductAcf['dodatne_opcije_' . $language]) : array();
                                            foreach ($additionalOptionsLeft as $option) {
                                                echo "<p>$option</p>";
                                            }
                                echo '  </div>
                                        <div class="additional-options-container">';
                                                echo '<h5>Dodatne opcije:</h5>';
                                                $additionalOptionsRight = isset($compareAcf['dodatne_opcije_' . $language]) ? explode("\r\n", $compareAcf['dodatne_opcije_' . $language]) : array();
                                                foreach ($additionalOptionsRight as $option) {
                                                    echo "<p>$option</p>";
                                                }
                                    echo '  </div>
                                    </div>
                                </div>
                            </div>';
                    }
                ?>
            </div>

        </div>
    </div>
</div>