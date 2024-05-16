<?php 
    include 'includes/global-header.php';
    require 'components/product-attributes.php';
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
    $category_name = $lang['global']['category'][$category_id];

    //Povezani proizvodi
    $thisProductId = $post['id'];
    $apiCatUrl = "$backendUrl/wp-json/wp/v2/proizvodi?category=$category_id&exclude=$thisProductId";
    $catData = json_decode(file_get_contents($apiCatUrl), true);
    $productCount = 0;
    
    $compare = '';
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
                    <button class="btn btn-secondary modal-open" data-trigger="product-to-compare"><i class="fi fi-rs-braille-d"></i>Compare</button>
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
                            echo '<a href="'.$thisProductAcf["dokument"].'" class="btn btn-white" download="download"><i class="fi fi-rs-file-download"></i>Preuzmi</a>';
                        }
                    ?>
                </div>
                <?php
                    echo attributes($thisProductAcf);
                ?>
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
            <h3 class="modal-title">Pošaljite nam email:</h3>
            <i class="fi fi-rs-cross modal-close"></i>
        </div>
        <div class="modal-content-body">
            <div class="compare-container">
                <?php 
                    if(isset($_GET['compareright'])) {
                        $compare = 'show';
                        $requestCompareUrl = $apiUrl . '?_embed&acf_format=standard&orderby=include&include=' . $post['id'] . ',' . $_GET['compareright'];
                        $compareData = json_decode(file_get_contents($requestCompareUrl), true);
                        foreach ($compareData as $compare) {
                            
                            //ACF
                            $compareAcf = $compare['acf'];

                            //Feature fotografija
                            $productImagecompare = $compareAcf['photo_gallery']['galerija'][0][0]['full_image_url'];

                            //Kategorija
                            $compareCategory_id = $compare['categories'][0];
                            $category_name = $lang['global']['category'][$compareCategory_id];

                            //titl
                            $compareTitleString = strip_tags($compare['title']['rendered']);
                            $cleanedCompareTitleString = str_replace($unwantedElements, "",  $compareTitleString);
                            $postCompareTitle = $cleanedCompareTitleString;

                            echo '<div class="compare-column">
                                    <div class="compare-feature-image">
                                        <img src="'.$productImagecompare.'"/>
                                    </div>
                                    <div class="product-header">
                                        <div class="product-name">
                                            <span>'.$category_name.'</span>
                                            <h1>'.$postCompareTitle.'</h1>
                                        </div>
                                    </div>
                                    '.attributes($compareAcf).'
                                </div>';
                        }
                        
                    }
                ?>
            </div>

        </div>
    </div>
</div>