<?php 
    // Function to generate attribute HTML
    function attribute($name, $value) {
        if ($value === '') {
            return '<div class="attribute attribute-unavailable">
                        <div class="attribute-description">
                            <h5>'.$name.'</h5>
                            <p>Nije dostupno</p>
                        </div>
                    </div>';
        } else {
            return '<div class="attribute attribute-available">
                        <div class="attribute-description">
                            <h5>'.$name.'</h5>
                            <p>'.$value.'</p>
                        </div>
                    </div>';
        }
    }
    
    // Function to generate basic attribute HTML
    function basicAttribute($name, $value, $icon) {
        return '<div class="basic-attribute">
                    <i class="fi '.$icon.'"></i>
                    <div class="basic-attribute-text">
                        <span>'.$name.'</span>
                        <h4>'.$value.'</h4>
                    </div>
                </div>';
    }
    
function attributes($acf) {
    $output = '<div class="product-attributes product-attributes-detailed">';

    
    // Generate detailed attributes HTML
    $output .= attribute('Prepoznavanje denominacije:', isset($acf['prepoznavanje_denominacije']) ? $acf['prepoznavanje_denominacije'] : '');
    $output .= attribute('Dodatne valute:', isset($acf['dodatne_valute']) ? $acf['dodatne_valute'] : '');
    $output .= attribute('Otkrivanje krivotvorina:', isset($acf['otkrivanje_krivotvorina']) ? $acf['otkrivanje_krivotvorina'] : '');
    $output .= attribute('Džep za odbijene novčanice:', isset($acf['dzep_za_odbijene_novcanice']) ? $acf['dzep_za_odbijene_novcanice'] : '');
    $output .= attribute('Skeniranje serijskih brojeva:', isset($acf['skeniranje_serijskih_brojeva']) ? $acf['skeniranje_serijskih_brojeva'] : '');
    $output .= attribute('Sortiranje:', isset($acf['sortiranje']) ? $acf['sortiranje'] : '');
    $output .= attribute('Mod mješovitih valuta:', isset($acf['mod_mesovitih_valuta']) ? $acf['mod_mesovitih_valuta'] : '');
    $output .= attribute('Portovi:', isset($acf['portovi']) ? $acf['portovi'] : '');
    
    $output .= '</div>';
    $output .= '<div class="basic-attributes">';
    $output .= basicAttribute('Max. counting speed (note/min):', isset($acf['maks_brzina_brojanja_notamin']) ? $acf['maks_brzina_brojanja_notamin'] : '', 'fi-rs-tachometer-alt-fastest');
    $output .= basicAttribute('Kapacitet (lijevak / džep / odbijeno):', isset($acf['kapacitet_lijevak__dzep__odbijeno']) ? $acf['kapacitet_lijevak__dzep__odbijeno'] : '', 'fi-rs-inbox');
    $output .= basicAttribute('Dimensions W / H / D (cm):', isset($acf['dimenzije_svd_cm']) ? $acf['dimenzije_svd_cm'] : '', 'fi-rs-ruler-triangle');
    $output .= basicAttribute('Weight (kg):', isset($acf['tezina_kg']) ? $acf['tezina_kg'] : '', 'fi-rs-scale');
    $output .= basicAttribute('Power supply:', isset($acf['napajanje']) ? $acf['napajanje'] : '', 'fi-rs-plug');
    $output .= basicAttribute('Power consumption:', isset($acf['potrosnja_energije']) ? $acf['potrosnja_energije'] : '', 'fi-rs-plug');
    $output .= '</div>';
    $output .= '<div class="additional-options">';
    $output .= '<h5>Additional options:</h5>';
    $output .= '<div class="additional-options-container">';
    
    // Generate additional options HTML
    $additionalOptions = isset($acf['dodatne_opcije']) ? explode("\r\n", $acf['dodatne_opcije']) : array();
    foreach($additionalOptions as $option) {
        $output .= "<p>$option</p>";
    }
    
    $output .= '</div></div>';
    
    return $output;
}
?>
