		<?php
			require "templates/footer.php";
		?>
		<script src="assets/js/contact-form-validator.js"></script>
		<script src="assets/js/modal.js"></script>
		<script src="assets/js/scripts.js" type="module"></script>
		<?php 
			require 'components/contact-modal.php';
		?>
				<script>
			$('#contact-form').validator();
		</script>
</body>
</html>