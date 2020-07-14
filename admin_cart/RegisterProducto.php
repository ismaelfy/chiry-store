<?php 
	session_start();
	require 'app/Producto.php';
	require 'app/User.php';	
	require 'app/Brand.php';	
	$Producto = new Producto();
	$Category = new Brand();

	$nombre = $_POST['nombre'];
	$descripcion = $_POST['descripcion'];
	$precio = $_POST['precio'];
	$stock = $_POST['stock'];
	$category = $_POST['category'];

	$foto = $_FILES['foto'];

	$oferta = 0;
	if (isset($_POST['oferta'])) {
		$oferta = 1;	
	}
	$nameimg = md5(basename($_FILES["foto"]["tmp_name"])).".jpg";	

	if ($foto["type"] == "image/jpg" OR $foto["type"] == "image/jpeg" OR $foto["type"] == "image/png") {
		
		$Producto = new Producto($nombre,$descripcion,$nameimg,$category,$precio,$stock,$oferta);		
		$result = $Producto->Registrar();		

		if ($result) {
			move_uploaded_file($_FILES["foto"]["tmp_name"],'../img/uploads/'.$nameimg );
			echo("registro con exito");
		} else {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'Error al registrar',
				  icon: 'warning',
				  button: 'aceptar',
				});
			});</script>";
		}		
	} else {
		echo "<script>$(document).ready(function() {
			swal({
			  title: 'La imagen debe ser con extension jpg, jpeg, png!',
			  icon: 'warning',
			  button: 'aceptar',
			});
		});</script>";
		exit();
	}


		

	















 ?>