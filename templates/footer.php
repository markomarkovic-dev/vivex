<?php 
    include 'components/socials.php';
?>
<footer class="footer">
    <div class="footer-container">
        <a href="home">
            <img src="assets/images/logo-primary.svg" alt="" class="logo">
        </a>
        <span class="footer-border"></span>
        <div class="footer-group">
            <a href="tel:+381 63 685 015" class="contact"><i class="fi fi-rs-phone-call"></i>+381 63 685 015</a>
            <span class="footer-border"></span>
            <a href="tel:+381 11 317 02 99" class="contact"><i class="fi fi-rs-phone-call"></i>+381 11 317 02 99</a>
        </div>
        <span class="footer-border"></span>
        <button class="btn btn-primary"><i class="fi fi-rs-envelope"></i>Send us an email</button>
        <span class="footer-border"></span>
        <span class="footer-border-horizontal"></span>
        <div class="footer-group">
            <?php 
                socials("footer");
            ?>
            <span class="footer-border footer-border-mobile"></span>
            <p class="copyright"><?= $lang['global']['copyright']?> &copy; <span><?= date('Y')?> Vivex</span></p>
        </div>
    </div>
</footer>