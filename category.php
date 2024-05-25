<?php 
    include 'includes/global-header.php'; 

    $queries = array();
    parse_str($_SERVER['QUERY_STRING'], $queries);

    //Povezani proizvodi
    $thisCategoryId = $queries['id'];
    $apiCatUrl = "$backendUrl/wp-json/wp/v2/proizvodi?categories=$thisCategoryId";
    $catData = json_decode(file_get_contents($apiCatUrl), true);
    
    if(!empty($catData)) {
        $category_id = $catData[0]['categories'][0];
        $category_name = $lang['global']['category'][$category_id]['title'];
    }

    $unwantedElements = array("&nbsp;", "<br>", "<br/>", "<p>", "</p>", "<strong>", "</strong>", "[…]");
    function attribute($name, $value) {
        if ($value === '') {
            return '<div class="attribute attribute-unavailable">
                        <div class="attribute-description">
                            <h5>'.$name.'</h5>
                        </div>
                    </div>';
        } else {
            return '<div class="attribute attribute-available">
                        <div class="attribute-description">
                            <h5>'.$name.'</h5>
                        </div>
                    </div>';
        }
    }
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
                    echo '<div class="products-grid">';
                    foreach($catData as $productPreview) {
                    
                        $titleString = strip_tags($productPreview['title']['rendered']);
                        $cleanedTitleString = str_replace($unwantedElements, "",  $titleString);
                        $thisProductAcf = $productPreview['acf'];
                        $gallery = $thisProductAcf['photo_gallery']['galerija'][0][0]['full_image_url'];
                        
                        $postTitle = $cleanedTitleString;
    
                        echo '<a href="product?id='.$productPreview['slug'].'" class="product">
                        <img src="'.$gallery.'" alt="">
                        <span class="product-category">' . $category_name . '</span>
                        <h4 class="product-name">' . $postTitle . '</h4>
                        <div class="product-attributes">';
                            echo attribute('Prepoznavanje apoena', isset($thisProductAcf['prepoznavanje_apoena_' . $language]) ? $thisProductAcf['prepoznavanje_apoena_' . $language] : '');
                            echo attribute('Dodatne valute', $thisProductAcf['dodatne_valute'] == true ? $thisProductAcf['dodatne_valute_' . $language] : '');
                            echo attribute('Detekcija falsifikata', isset($thisProductAcf['detekcija_falsifikata']) ? $thisProductAcf['detekcija_falsifikata'] : '');
                            echo attribute('Džep za odbačene novčanice', $thisProductAcf['dzep_za_odbacene_novcanice'] == true ? $thisProductAcf['dzep_za_odbacene_novcanice_' . $language] : '');
            
                        echo '</div></a>';
                    }
                } else {
                    echo '<div class="empty-message">
                            <i class="fi fi-rs-triangle-warning"></i>
                            <p>Trenutno nema proizvoda u ovoj kategoriji</p>
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