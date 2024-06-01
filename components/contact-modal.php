<?php
    $message = '';
    $modalOpen = '';
    $statusType = '';
    if(isset($_POST['submit'])){
        $namesurname = $_POST['name-surname'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $honeypot = $_POST['company-2'];
        $productName = $_POST['product-name'];

        // Validate input and check honeypot
        if(empty($namesurname) || empty($company) || empty($email) || empty($phone) || empty($message) || !empty($honeypot)){
            $message = $lang['global']['field-check'];
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $message = $lang['global']['email-error'];
        }
        else{
            // Send the email
            $to = 'markomarko988@gmail.com'; // Replace with your email address
            $subject = "Kontakt forma | $namesurname";

            if (!empty($productName)) {
                $subject .= " | Zatražena ponuda za $productName";
            }

            $body = "Ime: $name\nPrezime: $surname\nEmail: $email\nTelefon: $phone\nPoruka: $message";
            // $body = iconv(mb_detect_encoding($body, mb_detect_order(), true), "UTF-8", $body);

            // Check if $productName has a value before adding it to the email body
            if (!empty($productName)) {
                $body .= "\nProizvod: $productName";
            }

            $headers = "From: markomarko988@gmail.com\r\n";
            // $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            if(mail($to, $subject, $body, $headers)){
                $message = $lang['global']['message-success'];
                $statusType = 'success-message';
            }
            else{
                $message = $lang['global']['message-error'];
                $statusType = 'error-message';
            }
            $modalOpen = 'show';
        }
    }
?>

<div class="modal <?= $modalOpen?>" data-modal="contact-form">
    <div class="modal-content">
        <div class="modal-content-header">
            <h3 class="modal-title">Pošaljite nam email:</h3>
            <i class="fi fi-rs-cross modal-close"></i>
        </div>
        <div class="modal-content-body">
        <div class="contact-header">
            <img src="assets/icons/mail.svg" alt="">
            <div class="contact-header-text">
                <h4>Ukoliko imate pitanja slobodno nas kontaktirajte.</h4>
                <p>Ispunite svoje podatke i napišite nam poruku, a mi ćemo vam se javiti u najkraćem mogućem roku.</p>
            </div>
        </div>
        <form method="post" action="" class="contact-form" id="contact-form">
            <div class="input-wrapper product-name-select hidden">
                <label for="product-name">Naziv proizvoda:</label>
                <select name="product-name" id="product-name">
                    <?php 
                        if(isset($product_page)) {
                            $apiCatListUrl = "$backendUrl/wp-json/wp/v2/proizvodi?categories=$category_id";
                            $dataSelect = json_decode(file_get_contents($apiCatListUrl), true);
                            $productId = $queries['id'];

                            foreach($dataSelect as $productSelect) {
                                $productTitleSelect = strip_tags($productSelect['title']['rendered']);
                                $productTitleClean = str_replace($unwantedElements, "",  $productTitleSelect);
                                echo '<option value="' . $productTitleClean . '" ' . ($productId == $productSelect['slug'] ? 'selected' : '') . '>' . $productTitleClean . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="input-wrapper-split">
                <div class="input-wrapper form-group form-element">
                    <label for="name-surname"><?= $lang['global']['name-surname']?></label>
                    <input type="text" name="name-surname" id="name-surname" class="form-control" placeholder=" " data-error="<?= $lang['global']['field-required']?>" required>
                    <i class="fi fi-rs-cross clear-field"></i>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="input-wrapper form-group form-element">
                    <label for="company"><?= $lang['global']['company']?></label>
                    <input type="text" name="company" id="company" class="form-control" placeholder=" " data-error="<?= $lang['global']['field-required']?>" required>
                    <i class="fi fi-rs-cross clear-field"></i>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="input-wrapper-split">
                <div class="input-wrapper form-group form-element">
                    <label for="email"><?= $lang['global']['email']?></label>
                    <input type="email" name="email" id="email" class="form-control" placeholder=" " data-error="<?= $lang['global']['email-error']?>" required>
                    <i class="fi fi-rs-cross clear-field"></i>
                    <div class="help-block with-errors"></div>
                </div>
                <div class="input-wrapper form-group form-element">
                    <label for="phone"><?= $lang['global']['phone']?></label>
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder=" " data-error="<?= $lang['global']['field-required']?>" required>
                    <i class="fi fi-rs-cross clear-field"></i>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="input-wrapper form-group form-element">
                <label for="message"><?= $lang['global']['message']?></label>
                <textarea name="message" id="message" rows="5" class="form-control" placeholder=" " data-error="<?= $lang['global']['field-required']?>" required></textarea>
                <div class="help-block with-errors"></div>
            </div>
            <div class="input-wrapper hidden-field">
                <label for="company-2">Leave this field blank:</label>
                <input type="text" name="company-2" id="company-2">
            </div>
            <input type="submit" name="submit" id="send-button" class="btn btn-primary" value="<?= $lang['global']['send-message']?> &#8594">
        </form>
        <p class="email-app">Ili <a href="mailto:office@vivex.rs">koristite svoju email aplikaciju</a></p>
        <p class="send-message <?= $statusType?>"><?= $message; ?></p>
        </div>
    </div>
</div>