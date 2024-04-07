<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'includes/PHPMailer/src/PHPMailer.php';
require 'includes/PHPMailer/src/Exception.php';
require 'includes/PHPMailer/src/SMTP.php';

$modalPrikaz = ''; // Promjenljiva za prikaz modala
$notSentClass = ''; // Klasa za prikaz poruke o neuspješnom slanju
$message = ''; // Poruka

if (isset($_POST['submit'])) {
    // Očitavanje podataka sa forme
    $dateFrom = $_POST['date-from'];
    $dateTo = $_POST['date-to'];
    $guests = $_POST['guest-count'];
    $name = $_POST['name-surname'];
    $checkIn = $_POST['expected-checkin'];
    $phone = $_POST['tel'];
    $email = $_POST['email'];
    $notes = $_POST['additional-notes'];
    
    // Provjera za spam
    $company = $_POST['company'];

    // Kreiranje instance PHPMailer-a za prvi email (vlasniku sajta)
    $mail = new PHPMailer(true);

    // Postavljanje Karakterskog skupa i Enkodiranja
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    if(empty($company)) {
        try {
            // SMTP konfiguracija za email vlasnika
            $mail->isSMTP();
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Omogući TLS enkripciju
            $mail->Port = 587; // SMTP port; koristi 465 za `PHPMailer::ENCRYPTION_SMTPS` gore
            $mail->SMTPDebug = false;
            $mail->Host = 'smtp.hostinger.com'; // Zamjeni sa svojim SMTP serverom
            $mail->SMTPAuth   = true;
            require 'includes/smtp-credentials.php'; // Uključivanje kredencijala
            // Sadržaj emaila za vlasnika sajta
            $mail->setFrom('rezervacije@adanostra.com', 'Ada Nostra');
            $mail->addReplyTo('rezervacije@adanostra.com', 'Ada Nostra');
            $mail->addAddress('rezervacije@adanostra.com', 'Ada Nostra'); // Zameni sa emailom vlasnika
            $mail->isHTML(true);
            $mail->Subject = 'Nova rezervacija - '.$name.'';
            $mail->Body = "Dolazak: <b>$dateFrom</b><br>
                Odlazak: <b>$dateTo</b><br>
                Broj gostiju: <b>$guests</b><br>
                Ime i prezime: <b>$name</b><br>
                Očekivano vreme dolaska: <b>$checkIn</b><b>h</b><br>
                Broj telefona: <b>$phone</b><br>
                Email: <b>$email</b><br>
                Dodatne napomene: <b>$notes</b><br>
                " . (isset($home) ? '' : "Odabrani apartman: <b>" . $apartmentData[$apartmentId]['name'] . "</b>");        
            // Slanje emaila vlasniku
            $mail->send();
            
            // Email poslat posjetiocu
            $mail->clearAddresses();
            $mail->addAddress($email, $name); // Email posjetioca
            $mail->Subject = $lang['global']['reservation-details'] . ' - Ada Nostra';
            // Postavi putanju do HTML predloška emaila
            $templateFilePath = 'assets/email/reservation.html';
            // Čitanje sadržaja HTML fajla
            $emailTemplate = file_get_contents($templateFilePath);
            // Postavljanje tela emaila korišćenjem sadržaja HTML fajla
            // Zameni placeholder-e sa stvarnim vrijednostima
            $emailTemplate = str_replace(
                ['%RESPECTED%','%NAME%', '%DOMAIN%', '%THANKYOU%', '%CALLBACK%', '%FOREIGN%','%FOREIGNDATA%', '%AVAILABLE%', '%ADDITIONAL%', '%THANKYOUAGAIN%', '%RESPECTFULLY%'],
                [$lang['global']['mail-respected'], $name, $siteUrl, $lang['global']['mail-thankyou'], $lang['global']['mail-callback'], $lang['global']['mail-foreign'], $lang['global']['mail-foreign-data'], $lang['global']['mail-available'], $lang['global']['mail-additional'], $lang['global']['mail-thankyou-again'], $lang['global']['mail-respectfully']],
                $emailTemplate
            );
    
            // Postavi tijelo emaila koristeći modifikovani predložak
            $mail->Body = $emailTemplate;
            
            // Slanje emaila posjetiocu
            $mail->send();

            $apartmentPick = isset($home) ? "Apartman nije odabran" : $apartmentData[$apartmentId]['name'];

                /*********** Rezervacija  ************** */
                // Define the format of the input date
                $input_date_format = "d.m.Y";

                // Define the desired output format
                $output_date_format = "Y-m-d\TH:i:s";

                // Create DateTime objects for start and end dates
                $start_date_obj = DateTime::createFromFormat($input_date_format, $dateFrom);
                $end_date_obj = DateTime::createFromFormat($input_date_format, $dateTo);

                // Set the time for start and end dates
                $start_date_obj->setTime(18, 0, 0); // Assuming the start time is 18:00:00
                $end_date_obj->setTime(23, 0, 0); // Assuming the end time is 23:00:00

                // Format the dates according to the desired output format
                $start_date = $start_date_obj->format($output_date_format);
                $end_date = $end_date_obj->format($output_date_format);

                // API endpoint
                if (isset($home)) {
                    $url = "https://backend.adanostra.com/wp-json/tribe/events/v1/events";
                } else {
                    $url = "https://backend.adanostra.com/wp-json/tribe/events/v1/events?categories='.$apartmentId.'";
                }

                // Basic authentication credentials
                include 'includes/backend-credentials.php';

                // Event data
                $data = array(
                    'title' => $name. " - " . $apartmentPick,
                    'start_date' => $start_date,
                    'end_date' => $end_date
                );

                // Initialize cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                // Set basic authentication headers
                curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
                curl_setopt($ch, CURLOPT_USERPWD, "$wpBackendUsername:$wpBackendPassword");

                // Execute the request
                $response = curl_exec($ch);

                // Check for errors
                if(curl_errno($ch)) {
                    echo 'Error: ' . curl_error($ch);
                }

                // Close cURL resource
                curl_close($ch);
    
            echo "<script>window.location.href = 'thank-you.php?name=$name';</script>";
            exit(); // Zaustavi dalje izvršavanje nakon preusmjeravanja
    
        } catch (Exception $e) {
            $modalPrikaz = 'show';
            $message = $lang['global']['message-error'];
            exit(); // Zaustavi dalje izvršavanje nakon preusmjeravanja
        }
    } else {
        $modalPrikaz = 'show';
        $message = $lang['global']['message-error'];
        exit(); // Zaustavi dalje izvršavanje nakon preusmjeravanja
    }
}
?>
<!-- HTML Forma -->
<div class="modal <?= $modalPrikaz ?>" data-modal="reservation">
    <div class="modal-content">
        <img src="assets/icons/cross.svg" class="modal-close" alt="">
        <div class="modal-content-body">
            <!-- Forma za kontakt -->
            <form method="post" class="contact-form" id="reservation" data-ajax="false">
                <?php 
                    if(isset($home)) {
                        echo '<h4 class="modal-heading-msg">'.$lang['global']['form-heading-msg'] .'</h4>';
                    };
                ?>
                 
                <h2><?= $lang['global']['reservation-details'] ?></h2>
                <div class="form-field-container">
                    <!-- Polja forme -->
                    <div class="form-field-container">
                    <div class="input-wrapper input-wrapper-icon">
                        <img src="assets/icons/calendar-day.svg" alt="">
                        <label for="date-from"><?= $lang['global']['arrival'] ?></label>
                        <input type="text" name="date-from" id="date-from">
                    </div>
                    <div class="input-wrapper input-wrapper-icon">
                        <img src="assets/icons/calendar-day.svg" alt="">
                        <label for="date-to"><?= $lang['global']['departure'] ?></label>
                        <input type="text" name="date-to" id="date-to">
                    </div>
                    <div class="input-wrapper input-wrapper-icon">
                        <img src="assets/icons/guests-small.svg" alt="">
                        <label for="guest-count"><?= $lang['global']['guests'] ?></label>
                            <select id="guest-count" name="guest-count">
                                <?php 
                                    $guestCount = isset($home) ? 29 : $apartmentData[$apartmentId]["max-guests"];
                                    for ($i = 1; $i <= $guestCount; $i++) {
                                        echo '<option ' . ($i == 1 ? "selected" : "") . ' value="' . $i . '">' . $i . '</option>';
                                    }
                                ?>
                            </select>
                    </div>
                    <div class="form-field">
                        <div class="form-group form-element">
                            <label for="name-surname"><?= $lang['global']['name-surname'] ?></label>
                            <input id="name-surname" type="text" name="name-surname" class="form-control" required="required" data-error="<?= $lang['global']['field-required'] ?>" autocomplete="on">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-field">
                        <div class="form-group form-element">
                            <label for="tel"><?= $lang['global']['phone'] ?></label>
                            <input id="tel" type="tel" name="tel" class="form-control" required="required" data-error="<?= $lang['global']['field-required'] ?>" autocomplete="on">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-field">
                        <div class="form-group form-element">
                            <label for="email"><?= $lang['global']['email'] ?></label>
                            <input id="email" type="email" name="email" class="form-control" required="required" data-error="<?= $lang['global']['email-error'] ?>" autocomplete="on">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-field">
                        <div class="form-group form-element">
                            <label for="expected-checkin"><?= $lang['global']['expected-checkin-name'] ?></label>
                            <input id="expected-checkin" type="text" name="expected-checkin" class="form-control" required="required" data-error="<?= $lang['global']['field-required'] ?>" autocomplete="on">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="form-field">
                        <div class="form-group form-element">
                            <label for="additional-notes"><?= $lang['global']['additional-notes'] ?></label>
                            <textarea id="additional-notes" name="additional-notes" class="form-control" rows="5"></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-field hidden-field">
                        <div class="form-group form-element">
                            <label for="company"></label>
                            <input type="text" name="company" id="company">
                        </div>
                    </div>
                    <?php 
                        if (!isset($home)) {
                            echo "<p class='chosen-apartment'><span>" . $apartmentData[$apartmentId]['name'] . "</span></p>";
                            echo '<p id="price"><span id="price-label">'.$lang['global']['price'].'</span><span id="price-number">: '.$apartmentData[$apartmentId]['price'][$language].'</span><span id="currency">'.$lang['global']['currency'].'</span></p>';
                        }
                    ?>
                </div>
                    
                </div>
                <!-- Poruka nakon slanja forme -->
                <div class="messages"></div>
                <div class="form-field">
                    <div class="form-field-actions">
                        <div class="form-element">
                            <div class="contact-buttons-wrapper">
                                <button class="btn btn-secondary modal-close"><?= $lang['global']['cancel'] ?></button>
                            </div>
                        </div>
                        <div class="form-element submit-form">
                            <div class="contact-buttons-wrapper">
                                <input type="submit" id="send-button" name="submit" value="<?= $lang['global']['submit-reservation'] ?>" class="btn btn-primary">
                            </div>
                        </div>
                    </div>
            </form>
            <p class="message-on-submit <?= $notSentClass ?>"><?php echo $message; ?></p>
        </div>
        <p class="form-tip"><?= $lang['global']['form-tip'] ?></p>
    </div>
</div>
