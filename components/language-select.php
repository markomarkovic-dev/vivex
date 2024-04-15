<div class="nav-item nav-dropdown lang-dropdown">
    <?php
        switch ($language) {
            case "sr":
                echo '<a href="' . switchLang('/' . $language . '/', '/sr/') . '" class="active-language"><i class="fi fi-rs-earth-americas"></i> SRB</a>';
                break;
            case "ba":
                echo '<a href="' . switchLang('/' . $language . '/', '/ba/') . '" class="active-language"><i class="fi fi-rs-earth-americas"></i> BIH</a>';
                break;
            case "en":
                echo '<a href="' . switchLang('/' . $language . '/', '/en/') . '" class="active-language"><i class="fi fi-rs-earth-americas"></i> ENG</a>';
                break;
        }
    ?>
    <div class="dropdown">
        <div class="submenu-items">
            <div class="lang-select">
                <a href="<?= switchLang('/' . $language . '/', '/sr/') ?>" class="nav-item <?= $language === 'sr' ? 'active' : '' ?>"><img src="assets/icons/flag-srb.svg" alt="">SRB<?= $language === 'sr' ? '<i class="fi fi-rs-check"></i>' : '' ?></a>
                <a href="<?= switchLang('/' . $language . '/', '/en/') ?>" class="nav-item <?= $language === 'en' ? 'active' : '' ?>"><img src="assets/icons/flag-eng.svg" alt="">ENG<?= $language === 'en' ? '<i class="fi fi-rs-check"></i>' : '' ?></a>
                <a href="<?= switchLang('/' . $language . '/', '/ba/') ?>" class="nav-item <?= $language === 'ba' ? 'active' : '' ?>"><img src="assets/icons/flag-bih.svg" alt="">BIH<?= $language === 'ba' ? '<i class="fi fi-rs-check"></i>' : '' ?></a>
            </div>
        </div>
    </div>
</div>