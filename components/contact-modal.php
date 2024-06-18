<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'includes/PHPMailer/src/PHPMailer.php';
    require 'includes/PHPMailer/src/Exception.php';
    require 'includes/PHPMailer/src/SMTP.php';

    $message = '';
    $modalOpen = '';
    $statusType = '';

    if(isset($_POST['submit'])){
        $namesurname = $_POST['name-surname'];
        $company = $_POST['company'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $message = $_POST['message'];
        $productName = $_POST['product-name'];

        $honeypot = $_POST['company2'];
        $sendEmailAddress = $_POST['sendto'];

        // Kreiranje instance PHPMailer-a za prvi email (vlasniku sajta)
        $mail = new PHPMailer(true);

        // Postavljanje Karakterskog skupa i Enkodiranja
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        // Validate input and check honeypot
        if(empty($namesurname) || empty($company) || empty($email) || empty($phone) || empty($message) || !empty($honeypot) || empty($sendEmailAddress)){
            $message = $lang['global']['field-check'];
            $modalOpen = 'show';
        }
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !filter_var($sendEmailAddress, FILTER_VALIDATE_EMAIL)){
            $message = $lang['global']['email-error'];
            $modalOpen = 'show';
        }
        else{
            // SMTP konfiguracija za email vlasnika
            $mail->isSMTP();
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Omogući TLS enkripciju
            $mail->Port = 587; // SMTP port; koristi 465 za `PHPMailer::ENCRYPTION_SMTPS` gore
            $mail->SMTPDebug = false;
            $mail->Host = 'smtp.hostinger.com'; // Zamjeni sa svojim SMTP serverom
            $mail->SMTPAuth   = true;
            require 'includes/smtp-credentials.php'; // Uključivanje kredencijala
            // Sadržaj emaila za vlasnika sajta
            $mail->setFrom('noreply@hardcode.solutions', 'Vivex');
            $mail->addReplyTo($sendEmailAddress, 'Vivex');
            $mail->addAddress($sendEmailAddress, 'Vivex'); // Zameni sa emailom vlasnika
            $mail->isHTML(true);
            $mail->Subject = "Kontakt forma | $namesurname";
            if (!empty($productName)) {
                $mail->Subject .= " | Zatražena ponuda za $productName";
            }
            $mail->Body = "Ime i prezime: <b>$namesurname</b><br>
                Email: <b>$email</b><br>
                Telefon: <b>$phone</b><br>
                Poruka: <b>$message</b><br>
                ";
            if (!empty($productName)) {
                $mail->Body .= "Proizvod: <b>$productName</b>";
            }       
            //$mail->SMTPDebug = 2; // Ukljuci debugging
            //$mail->Debugoutput = 'html';
            // Slanje emaila vlasniku
            $mail->send();

            $message = $lang['global']['message-success'];
            $statusType = 'success-message';
            $modalOpen = 'show';

            // Redirect using JavaScript to the current URL with a success parameter
            //echo '<script>window.location.href = "' . $visitor_link . '?success=1";</script>';
            //exit();
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
                <h4><?= $lang['global']['form-heading-msg']?></h4>
                <p><?= $lang['global']['form-heading-desc']?></p>
            </div>
        </div>
        <form method="post" action="" class="contact-form" id="contact-form">
            <div class="input-wrapper product-name-select hidden">
                <label for="product-name"><?= $lang['global']['product-name']?></label>
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
                <label for="company2">Leave this field blank:</label>
                <input type="text" name="company2" id="company2">
            </div>
            <div class="input-wrapper hidden-field">
                <label for="sendto">Leave this field blank:</label>
                <input type="text" name="sendto" id="sendto">
            </div>
            <input type="submit" name="submit" id="send-button" class="btn btn-primary" value="<?= $lang['global']['send-message']?> &#8594">
        </form>
        <p class="email-app"><?= $lang['global']['email-app']?></a></p>
        <p class="send-message <?= $statusType?>"><?= $message; ?></p>
        </div>
    </div>
</div>