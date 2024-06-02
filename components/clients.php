<section class="client-section">
    <div class="section-container section-column">
        <h2 class="section-title"><?= $lang['global']['clients-heading']?></h2>
        <div class="client-grid">
            <?php 
                $clients = array(
                    "narodna-banka-srbije.svg",
                    "banca-intesa.svg",
                    "unicredit.svg",
                    "raiffeisen.svg",
                    "addiko-bank.svg",
                    "crowne-plaza.svg",
                    "delhaize.svg",
                    "nestle.svg",
                    "metro.svg",
                    "posta-crne-gore.svg",
                    "posta-srbije.svg",
                    "lukoil.svg",
                    "epcg.svg",
                    "eps.svg",
                    "zara.svg",
                    "mtel.svg",
                    "idea.svg",
                    "emmezeta.svg" 
                );

                foreach($clients as $client) {
                    $clientAlt = str_replace(".svg", "", $client);
                    $clientAlt = str_replace("-", " ", $clientAlt);
                    echo '<div class="client"><img src="assets/images/clients/'.$client.'" alt="'.$clientAlt.'"></div>';
                }
            ?>
        </div>
        <p><?= $lang['global']['clients-etc']?></p>
    </div>
</section>