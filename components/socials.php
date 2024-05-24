<?php 
    if (!function_exists('socials')) {

        function socials($param) {

            if ($param === "footer") {
                $facebookIcon = file_get_contents("assets/icons/facebook-dark.php");
                $linkedinIcon = file_get_contents("assets/icons/linkedin-dark.php");

                echo '
                    <div class="socials">
                        <a href="https://www.facebook.com/VivexGroupDoo/">' . $facebookIcon . '</a>
                        <a href="https://rs.linkedin.com/company/vivex-group-doo">' . $linkedinIcon . '</a>
                    </div>
                ';
            } else {
                echo '
                    <div class="socials">
                        <a href="https://www.facebook.com/VivexGroupDoo/"><img src="assets/icons/facebook.svg" alt="facebook link"></a>
                        <a href="https://rs.linkedin.com/company/vivex-group-doo"><img src="assets/icons/linkedin.svg" alt="linkedin link"></a>
                    </div>
                ';
            }
            
        }
    }
?>
