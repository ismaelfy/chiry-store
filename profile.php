<?php
session_start();
require_once 'includes/functions.php';
if (isset($_SESSION['u_inf'])) {
	$user = $_SESSION['u_inf'];

?>

	<!DOCTYPE html>
	<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title> chiry - Profile </title>
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

		<div class="contac">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-6 mb-3">
						<form class="upform p-sm-2 p-md-4 bg-white" value_name="update" method="POST" role="form">
							<h4>Datos de Perfil </h4>
							<div class="form-group">
								<label for="">Nombre</label>
								<input type="text" class="form-control" id="c_nombre" value='<?php echo $user['nombre']; ?>' placeholder="Escribe su nombre" required autofocus pattern="[A-Za-z ]{1,100}" autocomplete="off">
							</div>
							<div class="form-group">
								<label for="">Direccion</label>
								<input type="text" class="form-control" id="c_direccion" value='<?php echo $user['direccion']; ?>' placeholder="Escribe su direccion" pattern="[A-Za-z0-9. -]{1,100}" required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="">Email</label>
								<input type="text" class="form-control" id="c_email" value='<?php echo $user['email']; ?>' placeholder="Escribe su correo" pattern="[A-Za-z0-9.-@]{1,100}" required autocomplete="off">
							</div>
							<div class="form-group">
								<label for="">telefono</label>
								<input type="text" class="form-control" id="c_telefono" value='<?php echo $user['telefono']; ?>' placeholder="Escribe su N° celular" pattern="[0-9]{1,9}" required autocomplete="off">
							</div>
							<button type="submit" value_id='<?php echo $user['id']; ?>' class="btn_save btn btn-primary btn-block w-50 m-auto"> Guardar </button>
						</form>
					</div>

					<div class="col-sm-12 col-md-6">
						<form class="upp p-sm-2 p-md-4 bg-white" value_name="Change_pass" method="POST" role="form">
							<h4 class="text-center"> Actualizar Contraseña </h4>

							<div class="form-group">
								<input type="password" id="pass_old" required pattern="[A-Za-z0-9_-]{1,100}" class="form-control" placeholder="Contraseña actual">
							</div>

							<div class="form-group">
								<input type="password" id="pass_new" required pattern="[A-Za-z0-9_-]{1,100}" class="form-control" placeholder="Nueva contraseña">
							</div>

							<div class="form-group">
								<input type="password" id="pass_same" required pattern="[A-Za-z0-9_-]{1,100}" class="form-control" placeholder="Confirmar contraseña">
							</div>
							<button type="submit" class="change_pass btn btn-primary btn-block w-50 m-auto"> Actualizar </button>
						</form>
					</div>
				</div>

			</div>

			<div class="msj"></div>
		</div>

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

<?php
} else {
	header('location:./');
}
?>