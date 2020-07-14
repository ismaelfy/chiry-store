<?php
session_start();
require 'app/Producto.php';
require 'app/User.php';
require 'app/Brand.php';
require 'app/Pedidos.php';

$Producto = new Producto();
$Category = new Brand();
$Pedidos = new Pedidos();

if (isset($_POST['product'])) {
	$num_rows_prod =	$Producto->getNumRows();

	if ($num_rows_prod > 0) {
		$TAMANO_PAGINA = 3;
		$pagina = false;

		if (isset($_POST['idnext'])) {
			$pagina = $_POST['idnext'];
		}

		if (!$pagina) {
			$inicio = 0;
			$pagina = 1;
		} else {
			//RESETEAMOS LA VARIABLE INICIO A 0
			$inicio = ($pagina - 1) * $TAMANO_PAGINA;
		}

		$total_paginas = ceil($num_rows_prod / $TAMANO_PAGINA);

		$details = ListarProducto($inicio, $TAMANO_PAGINA);

		$_html = "
			<div class='row d-flex justify-content-center'>
				<div class='col-sm-11 option-bar mb-1'>
					<a class='btn btn-primary' href='#'> All </a>
					<a class='btn btn-light' href='#'> Today </a>
					<a class='btn btn-light' href='#'><i class='fa fa-file'></i> Exportar </a>
					<a class='addProd btn btn-success' href='#'>
						<i class='fa fa-plus'></i> Agregar 
					</a>
				</div>
				<div class='card product col-sm-11 border-0'>
					<div class='header-card p-1 pb-1 pt-4'> 
						<h5>Lista de Producto</h5> 
					</div>
					" . $details . "
					<div class='card-footer'>
						<ul class='pagination d-flex justify-content-center'>";
		if ($total_paginas > 1) {
			if ($pagina != 1)
				$_html .= "<li><a class='numpage' href='" . ($pagina - 1) . "'><i class='fa fa-angle-left'></i></a></li>";

			for ($i = 1; $i <= $total_paginas; $i++) {
				if ($pagina == $i)
					$_html .= "<li><a class='numpage active' href='0'>" . $pagina . "</a></li>";
				else
					$_html .= "<li><a class='numpage' href='" . $i . "'>" . $i . "</a></li>";
			}
			if ($pagina != $total_paginas)
				$_html .= "<li><a class='numpage' href='" . ($pagina + 1) . "'><i class='fa fa-angle-right'></i></a></li>";
		}
		$_html .= "		</ul>
					</div>
				</div>
			</div>";
		echo $_html;
	} else {
		echo "<span class='smj_prod'> No hay registro</span>";
	}
}

if (isset($_POST['newPro'])) {
	$Categories = "";
	$result = $Category->Listar();
	foreach ($result as $key => $value) {
		$Categories .= "<option value='$value->id'> $value->nombre</option>";
	}
	$_html = "<div class='row d-flex justify-content-center'>
			<div class='card product col-sm-11'>
					<div class='header-card text-center p-1 py-3'>
						<h4>Registrar producto</h4>
					</div>
					<div class='card-body p-4'>
						<form id='new_product' class='row' method='POST' enctype='multipart/form-data'>
							<div class='form-group col-sm-12'>
								<label> Nombre Producto </label>
								<input type='text' name='nombre' required class='form-control' placeholder='Nombre'/>
							</div>
							<div class='form-group col-sm-12'>
								<label> Descripcion </label>
								<textarea name='descripcion' class='form-control' required rows='3' placeholder='descripcion de articulo'></textarea>
							</div>
							<div class='form-group col-sm-6 col-md-4 mb-3'>
									<label for='precio'> Precio </label>
									<input type='text' name='precio' required class='form-control' placeholder='0.00' />
							</div>
							<div class='form-group col-sm-6 col-md-4 mb-3'>
								<label for='stock'> Stock </label>
								<input type='text' name='stock' required class='form-control' placeholder='0'/>
							</div>							
							<div class='form-group col-sm-6 col-md-4 mb-3'>
								<label for='category'> Categoria </label>
								<select required selected name='category' class='form-control'>
									<option value=''>  --- Seleccinar ---  </option>
									" . $Categories . "	
								</select>
							</div>							
							<div class='col-sm-6 col-md-4 mb-3'>
								<div class='custom-control custom-switch'>
  									<input type='checkbox' class='custom-control-input' name='oferta' value='1' id='oferta'/>
  									<label class='custom-control-label' for='oferta'> en oferta </label>
								</div>
							</div>
							<div class='form-group col-sm-12'>
								<div class='custom-file'>
									<input type='file' class='custom-file-input' id='foto' required name='foto' accept='image/x-png,image/gif,image/jpeg'/>
									<label class='custom-file-label' for='foto'> imagen del producto </label>
								</div>
							</div>
							<div class='formgroup col-sm-12'>
								<input type='submit'  value='Guardar' class='save_prod btn btn-primary'>
							</div>
						</form>
					</div>
				";
	echo $_html;
}

function ListarProducto($ini, $next)
{
	$_init = $ini;
	$_next = $next;
	$Producto = new Producto();
	$data = $Producto->Listar($_init, $_next);
	$items = "";
	foreach ($data as $value) {
		$items .= "<tr>
			<td>
				<img src='../img/uploads/" . $value->imagen . "' width='100'>
			</td>
			<td> " . $value->nombre . " </td>
			<td> " . $value->descripcion . " </td>
			<td> S/ " . $value->precio . " </td>
			<td> " . $value->stock . " </td>
			<td> " . $value->category . " </td>
			<td> 
				<a class='update btn btn-primary btn-sm mr-1 mb-1' href='" . $value->id . "'> 
					<i class='fa fa-edit'></i>
				</a>
				<a class='delete btn btn-danger btn-sm mb-1' href='" . $value->id . "'>
					<i class='fa fa-trash'></i>
				</a>
			</td>
		</tr>";
	}

	$_html = "<div class='card-body table-responsive p-1'>
					<table class='table '>
						<thead>
							<tr>
								<th> Imagen </th><th> Nombre </th>
								<th> Descripcion </th>
								<th> Precio </th>
								<th> Stock </th>
								<th> category </th>
								<th> Accion </th>
							</tr>
						</thead>
					<tbody> " . $items . " </tbody>
					</table>
				</div>";
	return $_html;
}

if (isset($_POST['log_a'])) {
	$user = $_POST['user'];
	$pass = md5($_POST['pass']);

	$User = new User();
	if (empty($user) || empty($pass)) {
		echo "<script>$(document).ready(function() {
				swal({
				  title: 'por favor completa los campos requeridos!',
				  icon: 'warning',
				  button: 'ok',
				});
			});</script>";
		exit(0);
	} else {

		$result = $User->Login_user($user, $pass);

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
		}
		elseif ($result != 0 || $result != 1) {

			$_SESSION['user_inf'] = array(
				'id' => $result[0]['id'],
				'nombre' => $result[0]['nombre'],
				'id_cargo' => $result[0]['id_cargo']
			);

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

if (isset($_POST['pedidos'])) {
	$result = $Pedidos->all();
	if ($result) {
		return sendData(["data" => $result, "status" => true]);
	}
	return sendData(["data" => null, "status" => false]);
}
if(isset($_POST['detail'])) {
	$id = $_POST['id'];	
	$result = $Pedidos->find_detail($id);
	if ($result) {
		return sendData(["data" => $result, "status" => true]);
	}
	return sendData(["data" => null, "status" => false]);
}


function sendData($data)
{
	echo json_encode($data);
}