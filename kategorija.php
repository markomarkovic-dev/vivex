<?php 
    require_once './config.php';
    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    //Povezani proizvodi
    $thisCategoryId = $queries['id'];
    $apiCatUrl = "$backendUrl/wp-json/wp/v2/proizvodi?categories=$thisCategoryId";
    $catData = json_decode(file_get_contents($apiCatUrl), true);
    
    if(!empty($catData)) {
        $category_id = $catData[0]['categories'][0];
        $category_name = $lang['global']['category'][$category_id]['title'];
        $postTitle = $category_name;
    }

    include 'includes/global-header.php';

    $unwantedElements = array("&nbsp;", "<br>", "<br/>", "<p>", "</p>", "<strong>", "</strong>", "[…]");
    
    include 'components/product-attributes.php';
?>
<main>
    <div class="cross-shapes category-shapes">
        <img src="assets/icons/logo-shape.svg" class="floating-img logo-shape" alt="">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small" alt="">
        <img src="assets/icons/logo-shape-small.svg" class="floating-img logo-shape-small-2" alt="">
    </div>
    <section class="page-padding">
        <div class="section-container">
            <h1 class="section-title-main"><?= $lang['global']['category'][$thisCategoryId]['title']?></h1>
            <p class="section-description"><?= $lang['global']['category'][$thisCategoryId]['description']?></p>
            <?php 
                if(!empty($catData)) {
                    echo '<div class="products-grid category-item">';
                    foreach($catData as $productPreview) {
                    
                        $titleString = strip_tags($productPreview['title']['rendered']);
                        $cleanedTitleString = str_replace($unwantedElements, "",  $titleString);
                        $thisProductAcf = $productPreview['acf'];
                        $gallery = $thisProductAcf['photo_gallery']['galerija'][0][0]['full_image_url'];
                        
                        $postTitle = $cleanedTitleString;
    
                        echo '<a href="proizvod?id='.$productPreview['slug'].'" class="product">
                        <img src="'.$gallery.'" alt="">
                        <span class="product-category">' . $category_name . '</span>
                        <h4 class="product-name">' . $postTitle . '</h4>
                        <div class="product-attributes">';
                        
                        attributes($thisProductAcf, 'mehanicka_brava', 'Mehanička brava');
                        attributes($thisProductAcf, 'elektronska_brava', 'Elektronska brava');
                        attributes($thisProductAcf, 'stepen_sigurnosti', 'Stepen sigurnosti');
                        attributes($thisProductAcf, 'punjen_betonom_'.$language, 'Punjen betonom');
                        attributes($thisProductAcf, 'zastita_od_busenja', 'Zaštita od bušenja');
                        attributes($thisProductAcf, 'zastita_od_vatre', 'Zaštita od vatre');
                        attributes($thisProductAcf, 'brava_sa_vremenom_zadrske', 'Brava sa vremenom zadrške');
                        attributes($thisProductAcf, 'depozitni_otvor', 'Depozitni otvor');
                        attributes($thisProductAcf, 'mogucnost_ankerisanja', 'Mogućnost ankerisanja');
                        attributes($thisProductAcf, 'prepoznavanje_apoena_'.$language, 'Prepoznavanje apoena');
                        attributes($thisProductAcf, 'dodatne_valute', 'Dodatne valute');
                        attributes($thisProductAcf, 'detekcija_falsifikata', 'Detekcija falsifikata');
                        attributes($thisProductAcf, 'dzep_za_odbacene_novcanice', 'Džep za odbačene novčanice');
                        attributes($thisProductAcf, 'skeniranje_serijskih_brojeva_'.$language, 'Skeniranje serijskih brojeva');
                        attributes($thisProductAcf, 'sortiranje_po_podobnosti', 'Sortiranje po podobnosti');
                        attributes($thisProductAcf, 'mod_mesanih_valuta', 'Mod mešanih valuta');
                        attributes($thisProductAcf, 'portovi', 'Portovi');
                        echo '</div></a>';
                    }
                } else {
                    echo '<div class="empty-message">
                            <i class="fi fi-rs-triangle-warning"></i>
                            <p>'.$lang['global']['no-products'].'</p>
                        </div>';
                }
                echo '</div>';
            ?>
        </div>
    </section>
    <section>
        <div class="section-container product-categories">
            <?php 
                require 'components/product-categories.php';
            ?>
        </div>
    </section>
</main>
<?php 
    include 'includes/global-footer.php'; 
?>
<script src="assets/js/owl.carousel.min.js"></script>