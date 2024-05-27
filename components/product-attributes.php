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
        if($value === '') {
            return;
        } else {
            return '<div class="basic-attribute">
            <i class="fi '.$icon.'"></i>
            <div class="basic-attribute-text">
                <span>'.$name.'</span>
                <h4>'.$value.'</h4>
            </div>
        </div>';
        }
     }

    //  function prepoznavanjeApoena($thisacf) {
    //     global $language;
    //     if (isset($thisacf['prepoznavanje_apoena_' . $language])) {
    //         echo attribute('Prepoznavanje apoena:', $thisacf['prepoznavanje_apoena_' . $language]);
    //     }
    //  }

    // function dodatneValute($thisacf) {
    //     global $language;
    //     if (isset($thisacf['dodatne_valute'])) {
    //         if($thisacf['dodatne_valute'] == true) {
    //             echo attribute('Dodatne valute:', $thisacf['dodatne_valute_' . $language]);
    //         } else {
    //             echo attribute('Dodatne valute:', '');
    //         }
    //     }
    // }

    // function detekcijaFalsifikata($thisacf) {
    //     if (isset($thisacf['detekcija_falsifikata'])) {
    //         echo attribute('Detekcija falsifikata:', $thisacf['detekcija_falsifikata']);
    //     }
    // }

    // function dzepOdbaceneNovcanice($thisacf) {
    //     global $language;
    //     if (isset($thisacf['dzep_za_odbacene_novcanice'])) {
                        
    //         if($thisacf['dzep_za_odbacene_novcanice'] == true) {
    //             echo attribute('Džep za odbačene novčanice:', $thisacf['dzep_za_odbacene_novcanice_' . $language]);
    //         } else {
    //             echo attribute('Džep za odbačene novčanice:', '');
    //         }
    //     }
    // }

    // function skeniranjeSerijskihBrojeva($thisacf) {
    //     global $language;
    //     if (isset($thisacf['skeniranje_serijskih_brojeva'])) {

    //         if($thisacf['skeniranje_serijskih_brojeva'] == true) {
    //             echo attribute('Skeniranje serijskih brojeva:', $thisacf['skeniranje_serijskih_brojeva_' . $language]);
    //         } else {
    //             echo attribute('Skeniranje serijskih brojeva:', '');
    //         }
    //     }
    // }

    // function sortiranjePodobnosti($thisacf) {
    //     global $language;
    //     if (isset($thisacf['sortiranje_po_podobnosti'])) {
    //         if($thisacf['sortiranje_po_podobnosti'] == true) {
    //             echo attribute('Sortiranje po podobnosti:', $thisacf['sortiranje_po_podobnosti_' . $language]);
    //         } else {
    //             echo attribute('Sortiranje po podobnosti:', '');
    //         }
    //     }
    // }

    // function modMesanihValuta($thisacf) {
    //     global $language;
    //     if (isset($thisacf['mod_mesanih_valuta'])) {
                        
    //         if($thisacf['mod_mesanih_valuta'] == true) {
    //             echo attribute('Mod mešanih valuta:', $thisacf['mod_mesanih_valuta_' . $language]);
    //         } else {
    //             echo attribute('Mod mešanih valuta:', '');
    //         }
    //     }
    // }
    
    // function portovi($thisacf) {
    //     if (isset($thisacf['portovi'])) {
    //         echo attribute('Portovi:', $thisacf['portovi']);
    //     }
    // }

    function attributes($attr, $attrLink, $attrName) {
        global $language;
        if (isset($attr[$attrLink])) {
            if($attr[$attrLink] === true && $attr[$attrLink] !== '') {
                echo attribute($attrName, $attr[$attrLink .'_'. $language]);
            } elseif ($attr[$attrLink] === false || $attr[$attrLink] === '') {
                echo attribute($attrName, '');
            } else {
                echo attribute($attrName, $attr[$attrLink]);
            }
        }
    }

    function basicAttributes($name, $attr, $icon) {
        if (isset($attr)) {
            echo basicAttribute($name, $attr, $icon);
        }
    }
?>