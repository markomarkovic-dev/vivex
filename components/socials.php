<?php 
    if (!function_exists('socials')) {
        function socials($param) {
            echo '
                <div class="socials">
                    <a href="https://www.facebook.com/VivexGroupDoo/"><img src="assets/icons/facebook'.($param === "footer" ? "-dark" : "").'.svg" alt="facebook link"></a>
                    <a href="https://rs.linkedin.com/company/vivex-group-doo"><img src="assets/icons/linkedin'.($param === "footer" ? "-dark" : "").'.svg" alt="linkedin link"></a>
                </div>
            ';
        }
    }
?>