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
    
    global $language;
    $output = '<div class="product-attributes product-attributes-detailed">';

    // Generate detailed attributes HTML
    $output .= attribute('Prepoznavanje denominacije:', isset($acf['prepoznavanje_denominacije_' . $language] ) ? $acf['prepoznavanje_denominacije_' . $language] : '');
    $output .= attribute('Dodatne valute:', $acf['dodatne_valute'] == true ? $acf['dodatne_valute_' . $language] : '');
    $output .= attribute('Detekcija falsifikata:', isset($acf['detekcija_falsifikata']) ? $acf['detekcija_falsifikata'] : '');
    $output .= attribute('Džep za odbačene novčanice:', $acf['dzep_za_odbacene_novcanice'] == true ? $acf['dzep_za_odbacene_novcanice_' . $language] : '');
    $output .= attribute('Skeniranje serijskih brojeva:', isset($acf['skeniranje_serijskih_brojeva']) ? $acf['skeniranje_serijskih_brojeva_' . $language] : '');
    $output .= attribute('Sortiranje po podobnosti:', isset($acf['sortiranje_po_podobnosti']) ? $acf['sortiranje_po_podobnosti_' . $language] : '');
    $output .= attribute('Mod mešanih valuta:', isset($acf['mod_mesanih_valuta']) ? $acf['mod_mesanih_valuta_' . $language] : '');
    $output .= attribute('Portovi:', isset($acf['portovi']) ? $acf['portovi'] : '');
    
    $output .= '</div>';
    $output .= '<div class="basic-attributes">';
    $output .= basicAttribute('Maks. brzina brojanja (novčanica/min):', isset($acf['maks_brzina_brojanja_novcanicamin']) ? $acf['maks_brzina_brojanja_novcanicamin'] : '', 'fi-rs-tachometer-alt-fastest');
    $output .= basicAttribute('Kapacitet (spremnik / obrađene / odbačene)::', isset($acf['kapacitet_spremnik_obradjene_odbacene']) ? $acf['kapacitet_spremnik_obradjene_odbacene'] : '', 'fi-rs-inbox');
    $output .= basicAttribute('Dimenzije (Š/V/D) (cm):', isset($acf['dimenzije_svd_cm']) ? $acf['dimenzije_svd_cm'] : '', 'fi-rs-ruler-triangle');
    $output .= basicAttribute('Težina (kg):', isset($acf['tezina_kg']) ? $acf['tezina_kg'] : '', 'fi-rs-scale');
    $output .= basicAttribute('Napajanje:', isset($acf['napajanje']) ? $acf['napajanje'] : '', 'fi-rs-plug');
    $output .= basicAttribute('Potrošnja:', isset($acf['potrosnja']) ? $acf['potrosnja'] : '', 'fi-rs-plug');
    $output .= '</div>';
    $output .= '<div class="additional-options">';
    $output .= '<h5>Dodatne opcije:</h5>';
    $output .= '<div class="additional-options-container">';
    
    // Generate additional options HTML
    $additionalOptions = isset($acf['dodatne_opcije_' . $language]) ? explode("\r\n", $acf['dodatne_opcije_' . $language]) : array();
    foreach($additionalOptions as $option) {
        $output .= "<p>$option</p>";
    }
    
    $output .= '</div></div>';
    
    return $output;
}
?>
