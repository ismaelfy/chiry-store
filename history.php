<?php
session_start();
require_once 'includes/functions.php';

if (!isset($_SESSION['u_inf'])) {
	header('location:./');
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> chiry - payment </title>
	<?php display_link(); ?>
</head>
<body>
	<?php display_header() ?>
	<section>
		<div class="container-f container">
			<div class="row">
				<div class=".col-sm-12 card detail-payment"></div>
			</div>
		</div>
	</section>
	<?php
	display_footer();
	display_script();
	?>
	<script>
		jQuery(document).ready(function($) {

			window.onload = function() {
				var loading = document.getElementById('loading');
				loading.style.visibility = 'hidden';
				loading.style.opacity = '0';
				loading.style.display = 'none';
			}
			/*cargar lista de carrito*/
			$.ajax({
					url: './valid',
					method: 'POST',
					data: {
						viewventa: 1
					},
				})
				.done(function(data) {
					$('.detail-payment').html(data);
				})
		});
	</script>

</body>

</html>