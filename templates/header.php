<header class="header">
    <div class="header-container">
        <div class="header-left">
        </div>
        <div class="header-right">
<div class="data-block">
    <a href="home">Početna</a>
</div>
            <div class="lang-select">
                <a href="<?= switchLang('/' . $language . '/', '/sr/')?>" class=" <?= $language === 'sr' ? 'active' : '' ?>">SR</a>
                <span>/</span>
                <a href="<?= switchLang('/' . $language . '/', '/en/')?>" class=" <?= $language === 'en' ? 'active' : '' ?>">EN</a>
                <span>/</span>
                <a href="<?= switchLang('/' . $language . '/', '/de/')?>" class=" <?= $language === 'de' ? 'active' : '' ?>">DE</a>
            </div>
        </div>
    </div>
    <img src="assets/icons/bars-staggered.svg" alt="" class="menu-switch">
</header>