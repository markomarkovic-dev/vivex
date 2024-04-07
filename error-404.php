<?php include('includes/global-header.php'); ?>
   <div class="layout-container">
    <?php
        require_once "templates/header.php";
    ?>
     <main>
            <section class="error-section">
                <h1>Stranica ne postoji.</h1>
                <a href='/' class="btn btn-primary"><i class="lnc lnc-home"></i>Vratite se na početnu</a>
            </section>
     </main>
        <?php
            require_once "templates/footer.php";
        ?>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script src="assets/js/scripts.js" type="module"></script>
    </div>      

<?php include('includes/global-footer.php'); ?>