<?php
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	session_start();
	require('app/Cliente.php');
	
	$name = "/^[a-zA-Z ]+$/";
	$direc = "/^[a-zA-Z0-9-. ]+$/";
	$emailValidation = "/^[._a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$number = "/^[0-9]+$/";	

	/*sign up*/
	if (isset($_POST["singup"])) {

		$nombre = $_POST['nombre'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		$pwd = md5($_POST['pwd']);
		if (empty($nombre) || empty($direccion) || empty($email) || empty($telefono) || empty($pwd)) {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'por favor completa los campos requeridos!',
				  icon: 'warning',
				  button: 'ok',
				});
			});</script>";
			exit(0);
		} else {
			if (!preg_match($name,$nombre)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El nombre no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";
				exit();
			}

			if (!preg_match($direc,$direccion)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'La direccion no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			if (!preg_match($emailValidation,$email)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El correo no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			if (!preg_match($number,$telefono)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El telefono no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";
				exit();
			}			
			if(strlen($pwd) < 6 ){
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'La contraseña debe tener minimo 6 caracteres!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			if(!(strlen($telefono) == 9)){
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El telefono debe tener 9 digitos!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
			exit();
			}

			$Cliente = new Cliente();
			$data = $Cliente->ValidarMail($email);
			if ($data != 0) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El correo ya existe!',
						  icon: 'error',
						  button: 'ok',
						});
					});</script>";
				exit();
			}
			else {
				$Cliente = new Cliente($nombre,$direccion,$email,$telefono,$pwd);
				$result =$Cliente->Registrar();
				if ($result) {
					echo "<script>$(document).ready(function() {
						swal({
						  title: 'Se registro con exito!',
						  icon: 'success',
						  button: 'aceptar',
						});	
					});</script>";					
					exit();		
				} else {
					echo "<script>$(document).ready(function() {
						swal({
						  title: 'Error al registrar!',
						  icon: 'error',
						  button: 'ok',
						});	
					});</script>";
					exit();
				}

			}

		}
	
	}

	/*actualizar datos del usuario*/
	if (isset($_POST["update_info"])) {

		$nombre = $_POST['nombre'];
		$direccion = $_POST['direccion'];
		$email = $_POST['email'];
		$telefono = $_POST['telefono'];
		
		if (empty($nombre) || empty($direccion) || empty($email) || empty($telefono)) {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'por favor completa los campos requeridos!',
				  icon: 'warning',
				  button: 'ok',
				});
			});</script>";
			exit(0);
		} else {

			if (!preg_match($name,$nombre)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El nombre no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";
				exit();
			}

			if (!preg_match($direc,$direccion)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'La direccion no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			if (!preg_match($emailValidation,$email)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El correo no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			if (!preg_match($number,$telefono)) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El telefono no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";
				exit();
			}								
			if(!(strlen($telefono) == 9)){
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'El telefono debe tener 9 digitos!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
			exit();
			}
			else {

				if (isset($_SESSION['u_inf'])) {
					$user = $_SESSION['u_inf'];
					$id= intval($user['id']);
					$Cliente = new Cliente();
					$result =$Cliente->Actualizar($id,$nombre,$direccion,$email,$telefono);
					if ($result) {						
						$_SESSION['u_inf']['nombre']=$nombre;
						$_SESSION['u_inf']['direccion']=$direccion;
						$_SESSION['u_inf']['email']=$email;
						$_SESSION['u_inf']['telefono']=$telefono;

						echo "<script>$(document).ready(function() {
							swal({
							  title: 'Se Actualizo con exito!',
							  icon: 'success',
							  button: 'aceptar',
							});	
						});</script>";	
						exit();		
					} else {
						echo "<script>$(document).ready(function() {
							swal({
							  title: 'Error al Actualizar!',
							  icon: 'error',
							  button: 'ok',
							});	
						});</script>";
						exit();
					}

				} else {
					echo "<script>$(document).ready(function() {
						swal({
						  title: 'debes iniciar sesion para actualizar!',
						  icon: 'success',
						  button: 'aceptar',
						});	
					});</script>";
					exit();
				}

			}

		}
	
	}
	/*cambiar contraseña*/
	if (isset($_POST["changp"])) {
		$oldpas=md5($_POST['oldp']);
		$newpas=md5($_POST['newp']);
		$samepas=md5($_POST['samep']);
		if (empty($oldpas) || empty($newpas) || empty($samepas)) {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'por favor completa los campos requeridos!',
				  icon: 'warning',
				  button: 'ok',
				});
			});</script>";
			exit(0);			
		} else {

			if ($newpas == $oldpas) {
				echo "<script>$(document).ready(function() {
					swal({
					  title: 'La nueva contraseña debe ser diferente!',
					  icon: 'error',
					  button: 'ok',
					});	
				});</script>";
				exit();
			}
			if ($newpas != $samepas) {
				echo "<script>$(document).ready(function() {
					swal({
					  title: 'las contraseñas no coinciden!',
					  icon: 'error',
					  button: 'ok',
					});	
				});</script>";
				exit();
			}
			if(strlen($newpas) < 5 ){
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'La contraseña debe tener minimo 5 caracteres!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";				
				exit();
			}
			else {

				if (isset($_SESSION['u_inf'])) {
					$user = $_SESSION['u_inf'];
					$id= intval($user['id']);
					$Cliente = new Cliente();
					$result =$Cliente->ValidarPwd($id,$oldpas);
					if ($result) {

						$resultado= $Cliente->updatePassword($id,$newpas);
						if ($resultado) {
							echo "<script>$(document).ready(function() {
								swal({
								  title: 'Se Actualizo con exito!',
								  icon: 'success',
								  button: 'aceptar',
								});	
							});</script>";	
						}else {
							echo "<script>$(document).ready(function() {
								swal({
								  title: 'Nose pudo actualizar!',
								  icon: 'error',
								  button: 'ok',
								});	
							});</script>";
							exit();	
						}
					} else {
						echo "<script>$(document).ready(function() {
							swal({
							  title: 'La contraseña actual no es correca!',
							  icon: 'error',
							  button: 'ok',
							});	
						});</script>";
						exit();
					}
				} else {
					echo "<script>$(document).ready(function() {
						swal({
						  title: 'debes iniciar sesion para actualizar!',
						  icon: 'success',
						  button: 'aceptar',
						});	
					});</script>";
					exit();
				}
			}
		}
	}


	/*login*/
	if (isset($_POST["sign"])) {
		$usu = $_POST['usu'];
		$pass = md5($_POST['pass']);
		$Cliente = new Cliente();
		$result= $Cliente->Login_user($usu,$pass);
		if ($result == 0) {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'El correo no esta registrado',
				  icon: 'error',
				  button: 'ok',
				});	
			});</script>";
			exit();
		} else if ($result == 1) {
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'Su contraseña es incorrecta!',
				  icon: 'error',
				  button: 'ok',
				});	
			});</script>";
			exit();
		} else if($result!= 0 || $result!=1) {
			
			$_SESSION['u_inf'] = array('id' =>$result[0]['id'],'nombre' =>$result[0]['nombre'],'direccion' =>$result[0]['direccion'],'email' =>$result[0]['email'],'telefono'=>$result[0]['telefono']);
			
			echo "<script>$(document).ready(function() {
				swal({
				  title: 'Login exitoso!',
				  icon: 'success',
				  button: 'aceptar',
				});	
				setTimeout(function() { window.location.reload();}, 1000);
			});</script>";
			exit();
		}

	
	}


}


	
	
		















 ?>