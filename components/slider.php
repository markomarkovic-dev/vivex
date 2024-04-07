<?php
    function landingSlider($sliderType, $apartmentName) {
        foreach ($sliderType as $slide) {
            echo '<div class="item">
                <img src="assets/images/apartment-' . $apartmentName . '/' . $slide . '" class="feature-image" alt="">
            </div>';
        };
    };
?>