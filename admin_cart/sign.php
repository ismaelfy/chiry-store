<?php 
	session_start();
	require_once 'includes/functions.php';
	/*session_destroy();*/
	if (isset($_SESSION['user_inf'])) {
		/*$user = $_SESSION['u_inf'];
		echo $user['id'];*/
		header('location:./');
	} else {
?>

<!DOCTYPE html>
<html>
<head>	
	<title>chiry admin - Login </title>
	<?php display_link();?>
</head>
<body>
<section id="main">
	<div class="smslog"></div>
	<div class="container-form">
		<form id="login_form"  method="POST" >
			<legend> Iniciar Sesion </legend>
		
			<div class="form-group">
				<i class="fa fa-user"></i>
				<input type="text" class="form-control" id="user" pattern="[A-Za-z0-9.-@]{1,100}" required maxlength="20" placeholder="usuario">
			</div>
			<div class="form-group">
				<i class="fa fa-lock"></i>
				<input type="password" class="form-control" id="pwd" pattern="[A-Za-z0-9_-]{1,100}" required maxlength="20" placeholder="password">
			</div>	
			<input type="submit" class="login_ad btn btn-primary" value=" Iniciar ">			

		</form>
	</div>
	
</section>

<?php display_scripts(); ?>


</body>
</html>

<?php 
	}

 ?>