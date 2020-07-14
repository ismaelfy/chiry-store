<?php
session_start();
require_once 'includes/functions.php';

/*session_destroy();*/
if (isset($_SESSION['u_inf'])) {
	header('location: ./');
}
?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> Chiry - login </title>
	<?php display_link(); ?>
	<link rel="stylesheet" href="./css/log.css">

</head>

<body>
	<?php display_header() ?>
	<section class="main">
		<div class="user_options-container container">
			<div class="user_options-text">
				<div class="user_options-unregistered">
					<h2 class="user_unregistered-title">¿Aun no tienes cuenta?</h2>
					<p class="user_unregistered-text"> Regístrate en pocos segundos. </p>
					<button class="user_unregistered-signup" id="signup-button">Registrar</button>
				</div>

				<div class="user_options-registered">
					<h2 class="user_registered-title">¿Ya tienes una cuenta?</h2>
					<p class="user_registered-text"> Inicia sesión para ver tus pedidos. </p>
					<button class="user_registered-login" id="login-button">Login</button>
				</div>

			</div>

			<!-- form login and sign up -->
			<div class="user_options-forms" id="user_options-forms">
				<div class="user_forms-login">
					<h2 class="forms_title pt-md-4">Iniciar Sesion</h2>
					<form class="forms_form" value_name="sign">
						<fieldset class="forms_fieldset">
							<div class="forms_field">
								<input id="correo_l" type="email" name="emial"  placeholder="Email" class="forms_field-input" required autofocus />
							</div>

							<div class="forms_field">
								<input id="pwd_l" type="password" name="pwd" pattern="[A-Za-z0-9_-]{1,100}" placeholder="Contraseña" class="forms_field-input" required />
							</div>
						</fieldset>
						<div class="forms_buttons">
							<input id="login-send" type="submit" value="Log In" class="forms_buttons-action">
							<button type="button" class="forms_buttons-forgot">¿Olvidaste tu Contraseña?</button>
						</div>

					</form>
				</div>

				<!-- registration forms-->

				<div class="user_forms-signup">

					<h2 class="forms_title">Registrarse</h2>

					<form class="forms_form" id="sign_up" value_name="sig_up" name="frmregistrar">
						<fieldset class="forms_fieldset">
							<div class="forms_field">
								<input id="nombre" type="text" required autofocus pattern="[A-Za-z ]{1,100}" name="nombre" placeholder="Nombre" class="forms_field-input" />
							</div>

							<div class="forms_field">
								<input id="direccion" required name="direccion" pattern="[A-Za-z0-9. -]{1,100}" type="text" placeholder="Direccion" class="forms_field-input" />
							</div>

							<div class="forms_field">
								<input id="email" type="email" required name="email" pattern="[A-Za-z0-9.-@]{1,100}" placeholder="Email" class="forms_field-input" />
							</div>

							<div class="forms_field">
								<input id="telefono" type="text" required name="telefono" pattern="[0-9]{1,9}" placeholder="Celular" maxlength="9" class="forms_field-input" />
							</div>

							<div class="forms_field">
								<input id="pass" type="password" required name="pwd" pattern="[A-Za-z0-9_-]{1,100}" placeholder="Password" class="forms_field-input" />
							</div>

						</fieldset>
						<div class="forms_buttons" style="margin-top: 10px;">
							<input id="registrar" type="submit" value="Registrar" class="forms_buttons-action">
						</div>
					</form>

				</div>
				<div class="msj"></div>
			</div>
		</div>
	</section>


	<?php

	display_footer();
	display_script();
	?>
	<script src="./js/log.js"></script>

	<script>
		jQuery(document).ready(function($) {
			window.onload = function() {
				var loading = document.getElementById('loading');
				loading.style.visibility = 'hidden';
				loading.style.opacity = '0';
				loading.style.display = 'none';
			}
		});
	</script>

</body>

</html>