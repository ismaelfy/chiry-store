<?php
	session_start();
	require_once 'includes/functions.php';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">	
	<title> Carrito de compras </title>
	<?php display_link(); ?>
</head>

<body>
	<?php display_header(1) ?>
	<!-- visualizar carrito -->
	<div class="view_cart_prod">
		<div class="cart_prod">
			<div class="nav_car">
				<div class="box_close">
					<button id="close_v"> > </button>
				</div>
				<div class="title_cart">
					<p>Detalle de carrito</p>
				</div>
			</div>
			<div class="container-prod">

			</div>

		</div>
	</div>

	<div class="modal">
		<div class="conte">

		</div>
	</div>

	<section id="product" class="p-0">
		<div class="msj"></div>
		<div class="conte-all">
			<div class="row_p"></div>

		</div>

	</section>

	<?php 
	
	display_footer();
	display_script();
	?>
	
	<script>
		window.onload = function() {
			var loading = document.getElementById('loading');
			loading.style.visibility = 'hidden';
			loading.style.opacity = '0';
			loading.style.display = 'none';
		}
	</script>

</body>

</html>