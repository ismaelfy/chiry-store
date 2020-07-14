<?php
session_start();
require_once 'includes/functions.php';
require_once 'paypal/config.php';

if (isset($_SESSION['u_inf'])) {
	$user = $_SESSION['u_inf'];
	//print_r($user);
?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title> chiry- payment </title>
		<?php display_link(); ?>
	</head>

	<body id="payment-f">
		<?php display_header() ?>

		<section class="paymentform bg-white">

			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-6">
						<div class="card detail-payment"></div>
					</div>

					<div class="col-sm-12 col-md-6">
						<div class="row p-0 m-0">
							<div class="card col-sm-12">
								<div class="card-header">
									Detalle de la cuenta
								</div>
								<div class="card-body">
									<form class="upform form-row" value_name="update" action="" method="POST" role="form">
										<div class="form-group col-sm-12 col-md-6 mb-1">
											<input type="text" readonly="true" class="form-control" id="c_nombre" value='<?php echo $user['nombre']; ?>' placeholder="Escribe su nombre" required autofocus pattern="[A-Za-z ]{1,100}" autocomplete="off">
										</div>
										<div class="form-group col-sm-12 col-md-6 mb-1">
											<input type="email" readonly="true" class="form-control" id="c_email" value='<?php echo $user['email']; ?>' placeholder="Escribe su correo" pattern="[A-Za-z0-9.-@]{1,100}" required autocomplete="off">
										</div>
										<div class="form-group col-sm-12 mb-1">
											<input type="text" readonly="true" class="form-control" id="c_direccion" value='<?php echo $user['direccion']; ?>' placeholder="Escribe su direccion" pattern="[A-Za-z0-9. -]{1,100}" required autocomplete="off">
										</div>

										<div class="form-group col-sm-12 mb-1">
											<input type="text" readonly="true" class="form-control" id="c_telefono" value='<?php echo $user['telefono']; ?>' placeholder="Escribe su N° celular" pattern="[0-9]{1,9}" required autocomplete="off">
										</div>
									</form>
								</div>
							</div>

							<div class="col-sm-12 card">
								<div class="card-header">
									Selecciona tipo de pago
								</div>
								<div class="card-body p-3">
									<form id="form-payment" class="form-row">
										<div class="col-sm-12 mb-2">
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="pago_entrega">
												<label class="custom-control-label" for="pago_entrega"> Pago contraentrega </label>
											</div>
										</div>
										<div class="col-sm-12 mb-2">
											<button type="submit" class="btn btn-warning btn-block font-weight-bold " id="btn-paypal">
												<i class="fab fa-paypal mr-2"></i> PayPal
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>

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
				$.ajax({
						url: 'valid.php',
						method: 'POST',
						data: {
							view_pay: 1
						},
					})
					.done(function(data) {
						$('.detail-payment').html(data);
					})
			});
		</script>


		<script src="https://www.paypal.com/sdk/js?client-id=<?= CLIENTE_ID ?>&commit=false"></script>
		<script src="paypal/paypal.js"></script>
	</body>

	</html>
<?php
} else {
	header('location:./');
}

?>