<?php
session_start();
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Detalle de carrito</title>

	<?php display_link(); ?>

</head>

<body id="det">
	<?php display_header() ?>

	<section class="contenido">
		<div class="container">
			<div class="row">
				<div class="title">
					<h2>Cart Checkout</h2>
				</div>
				<div class="detail-cart"></div>
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
					url: 'valid.php',
					method: 'POST',
					data: {
						view_cart: 1
					},
				})
				.done(function(data) {
					$('.detail-cart').html(data);
				})
		});
	</script>

</body>

</html>