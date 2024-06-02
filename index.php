<?php

//include('includes/header.php');
include('./config.php');

//content start

//redirekcija u slucaju pristupanja bez imena stranice
    flush();
    header("Location: naslovna.php", true, 301);
    die('should have redirected by now');
?>