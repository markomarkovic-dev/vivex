<?php 
    include('./config.php'); 
    $checkMetaImg = "$siteUrl/assets/images/meta-image.png";
    $pageTitle = $lang[$pagename]['title'];
    $pageDescription = $lang[$pagename]['description'];
    switch ($language) {
        case 'en':
            $contentLang = "English";
            break;
        case 'sr':
            $contentLang = "Serbian";
            break;
        case 'ba':
            $contentLang = "Bosnian";
            break;
        default:
            $contentLang = "Unknown Language";
            break;
    }
?>
<!DOCTYPE html>
<html lang="<?php echo $language;?>">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-KSLZN5HV');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle . " | " . $siteName?></title>
    <meta name="title" content="<?= $pageTitle ?> | <?= $siteName ?>">
    <meta name="description" content="<?= $pageDescription ?>">
    <meta name="keywords" content="apartmani">
    <meta name="robots" content="index, follow">
    <meta name="language" content="<?= $contentLang ?>">
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= $visitor_link?>">
    <meta property="og:title" content="<?= $pageTitle ?> | <?= $siteName ?>">
    <meta property="og:description" content="<?= $pageDescription ?> ">
    <meta property="og:image" content="<?= $checkMetaImg?>">
    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= $visitor_link?>">
    <meta property="twitter:title" content="<?= $pageTitle ?> | <?= $siteName ?>">
    <meta property="twitter:description" content="<?= $pageDescription?>">
    <meta property="twitter:image" content="<?= $checkMetaImg?>">    
    <link rel="apple-touch-icon" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="assets/favicon/site.webmanifest">
    <meta name="apple-mobile-web-app-title" content="<?= $siteName?>">
    <meta name="application-name" content="<?= $siteName?>">
    <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#ff0000">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/fonts/uicons/uicons-regular-straight.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="assets/scss/main.css">

	<?php 
		//generisanje alternate linkova za multijezicke sajtove
		foreach ($langlinks as $link) {
			$langurl = str_replace($language, $link, $url);
			echo '<link rel="alternate" hreflang="'.$link.'" href="'.$langurl.'" />';
		}
	?>

	<script src="assets/js/jquery-3.7.1.min.js"></script>
	
</head>
<body class="<?= $pagename;?>-page" <?= isset($apartmentId) ? 'id="'.$apartmentId.'"' : '';?>>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KSLZN5HV"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
<?php 
    require 'templates/header.php';
?>