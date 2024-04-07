<?php
include 'includes/global-header.php';
$name = $_GET['name'];
?>

<main>
    <section class="thank-you">
        <div class="section-container">
            <span class="sup-heading"><?= $lang['global']['respected'] . " " . $name ?></span>
            <h2 class="section-heading"><?= $lang[$pagename]['thanks-for-reservation'] ?></h2>
            <?= $lang[$pagename]['thank-you-text']?>
        </div>
    </section>
</main>
<?php include('includes/global-footer.php'); ?>