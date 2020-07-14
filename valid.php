<?php
session_start();
require('app/Brand.php');
require('app/Producto.php');
require('app/Cliente.php');
require('app/Suscribe.php');
require('app/favorite.php');
require('app/ventas.php');
require('app/detalleProd.php');

$Brand = new Brand();
$Producto = new Producto();
$Cliente = new Cliente();
$Favorite = new Favorite();
$Ventas = new Ventas();
$Detalleventa = new Detalleventa();


/*Lista de categoria*/
if (isset($_POST["brand"])) {
	$data = $Brand->Listar();
	if ($data != 0) {
		$_html = "<option value='0'>All category </option>'>";
		foreach ($data as $key => $value) {
			$_html .= "<option value='" . $value->id . "'>" . $value->nombre . "</option>'>";
		}
		echo $_html;
	}
}

/*Lista de producto*/
if (isset($_POST["product"])) {

	$data = $Producto->Listar();
	$_html = "<div class='list-product'><div class='conte-prod row'>";
	if ($data != 0) {
		foreach ($data as $key => $value) {
			$_html .= " <div class='col-sm-6 col-md-4 col-lg-3 mb-3'>
					<div class='box-prod'>
						<div class='img-prod'>
						<a value='" . $value->id . "' class='view_det'>
							<img src='img/uploads/" . $value->imagen . "'>
						</a>
					</div>
					<div class='detalle-prod p-2 pb-3'>
					<div class='p-detail'>
						<b class='name-prod'> " . $value->nombre . "</b> 
						<span class='precio'>S/. " . $value->precio . "</span>
						</div><div class='option'>
						<a class='view_det' value='" . $value->id . "'>ver mas</a><a class='love' value='" . $value->id . "'>
							<i class='fa fa-heart'></i></a></div></div>";
			if ($value->oferta != 0) {
				$_html .= "<span class='ofert'>oferta</span>";
			}
			$_html .= "</div> </div>";
		}
	} else {
		$_html .= "<span> No tienes productos agregados</span>";
	}

	$_html .= "</div></div>";
	echo $_html;
}

/*Lista de producto favoritos*/
if (isset($_POST["fav"])) {
	$user = $_SESSION['u_inf'];
	$idUs = $user['id'];

	$data = $Favorite->ListarOferta($idUs);
	$_html = "<div class='list-product'><div class='conte-prod row'>";
	if ($data != 0) {
		foreach ($data as $key => $value) {
			$_html .= "<div class='col-sm-6 col-md-4 col-lg-3 mb-3'>
						<div class='box-prod'>
							<div class='img-prod'>
								<a value='" . $value->id . "' class='view_det'>
									<img src='img/uploads/" . $value->imagen . "'>
								</a>
							</div>
						<div class='detalle-prod p-2 pb-3'>
							<div class='p-detail'>
								<b class='name-prod'>" . $value->nombre . "</b>
								<span class='precio'>S/. " . $value->precio . "</span>
							</div>
							<div class='option'>
								<a class='view_det' value='" . $value->id . "'>ver mas</a>
								<a class='love active' value='" . $value->id . "'>
									<i class='fa fa-heart'></i>
								</a>
							</div>
						</div>";
			if ($value->oferta != 0) {
				$_html .= "<span class='ofert'>oferta</span>";
			}

			$_html .= "<span class='edit' value='" . $value->id . "'>
						<i class='fa fa-trash'></i></span>
					</div> </div>";
		}
	} else {
		$_html .= "<span> No tienes productos agregados</span>";
	}

	$_html .= "</div></div>";
	echo $_html;
}

/*Lista producto por category, buscar producto*/
if (isset($_POST["search"])) {

	$idcate = intval($_POST['cate']);
	$nomProd = $_POST['searchn'];
	$name = "/^[ a-zA-Z ]+$/";

	echo $nomProd;
	if ($nomProd != '') {
		if (!preg_match($name, $nomProd)) {
			echo "<script>$(document).ready(function() {
						swal({
						  title: 'Caracter ingresado no es valido!',
						  icon: 'warning',
						  button: 'ok',
						});	
					});</script>";
			exit();
		}
	}

	if ($idcate == 0 && empty($nomProd)) {
		$data = $Producto->Listar();
	}
	if ($idcate == 0 && $nomProd != '') {
		$data = $Producto->Buscar(0, $nomProd);
	}
	if ($idcate != 0 && $nomProd == '') {
		$data = $Producto->Buscar($idcate, 0);
	}
	if ($idcate != 0 && $nomProd != '') {
		$data = $Producto->Buscar($idcate, $nomProd);
	}

	/*lista todos los productos */
	$_html = "<div class='list-product'><div class='conte-prod'>";
	if ($data != 0) {

		foreach ($data as $key => $value) {
			$_html .= "<div class='box-prod'><div class='img-prod'><a value='" . $value->id . "' class='view_det'>";
			$_html .= "<img src='img/uploads/" . $value->imagen . "'></a></div><div class='detalle-prod'>";
			$_html .= "<div class='p-detail'><b class='name-prod'>" . $value->nombre . "</b>";
			$_html .= "<span class='precio'>S/. " . $value->precio . "</span></div><div class='option'>";
			$_html .= "<a class='view_det' value='" . $value->id . "'>ver mas</a><a class='love' value='" . $value->id . "'>";
			$_html .= "<i class='fa fa-heart'></i></a></div></div>";

			if ($value->oferta != 0) {
				$_html .= "<span class='ofert'>oferta</span>";
			}

			$_html .= "</div>";
		}
	} else {
		$_html .= "<span> No se encontro productos </span>";
	}

	$_html .= "</div></div>";
	echo $_html;
	exit();
}


/*Visualizar el producto*/
if (isset($_POST["view_prod"])) {
	$idProduct = $_POST['idProd'];
	$data = $Producto->ViewProducto($idProduct);
	if ($data != 0) {
		foreach ($data as $key => $value) {
			$_html = "<div class='title'>
						<h3>Detalle de producto</h3>
						<a class='close_mod'>x</a>
					</div>
					<div class='prod_mod row'>
						<div class='prod-img col-sm-12 col-md-6'>
							<img src='img/uploads/" . $value->imagen . "'/>
						</div>
						<div class='prod-detail col-sm-12 col-md-6'>
							<h6 class='name-prod'>" . $value->nombre . "</h6>
							<p>Precio</p><span class='precio'>S/. " . $value->precio . "</span>
							<p>descripcion</p><span class='descrip'>" . $value->descripcion . "</span>
							<div class='box-buy'>
								<a class='addCart btn btn-success text-white' value_id='" . $value->id . "'>Agregar carrito</a>
							</div>
						</div>
					</div>";
			echo $_html;
		}
	}
}

/*vesualizar carrito*/
if (isset($_POST["cart_view"])) {
	ViewCart();
}

/*listar carrito */
if (isset($_POST["view_cart"])) {
	ListarCart();
}
if (isset($_POST["view_pay"])) {
	ViewPayment();
}
/*eliminar carrito*/
if (isset($_POST["del_cart"])) {
	$id_cart = $_POST['idCart'];
	remove_cart($id_cart);
	ListarCart();
}

/*agregar producto a cart*/
if (isset($_POST["addProd"])) {
	$idProduct = $_POST['idCart'];
	$data = $Producto->ViewProducto($idProduct);
	agregar_carrito($idProduct);
	if ($data != 0) {
		ViewCart();
	} else {
		echo "false";
	}
}

/*eliminar carrito*/
if (isset($_POST['removef'])) {
	if (isset($_SESSION['u_inf'])) {
		$user = $_SESSION['u_inf'];

		$idprod = intval($_POST['id_Prod']);
		$idclient = intval($user['id']);
		$Favorite = new Favorite();
		$result = $Favorite->Eliminar($idprod, $idclient);

		if ($result) {
			echo "1";
		} else {
			echo "0";
		}
	} else {
		echo "<script>$(document).ready(function() {
				swal({
				  title: 'para eliminar de favoritos, debes iniciar sesion!',
				  icon: 'error',
				  button: 'aceptar',
				});
			});</script>";
	}
}

/* agregar a favoritos */
if (isset($_POST["idlove"])) {
	if (isset($_SESSION['u_inf'])) {
		$user = $_SESSION['u_inf'];

		$idprod = intval($_POST['id_Prod']);
		$idclient = intval($user['id']);
		$Favorite = new Favorite($idprod, $idclient);
		$num_rows = $Favorite->CountFav($idprod, $idclient);

		if ($num_rows > 0) {
			echo "<script>$(document).ready(function() {
						swal({
						  title: 'El producto ya esta en favoritos :)',
						  icon: 'warning',
						  button: 'aceptar',
						});
					});</script>";
			exit();
		} else {

			$data = $Favorite->Registrar();
			if ($data) {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'se agrego a favoritos :)',
						  icon: 'success',
						  button: 'aceptar',
						});
					});</script>";
			} else {
				echo "<script>$(document).ready(function() {
						swal({
						  title: 'algo salio mal :(!',
						  icon: 'warning',
						  button: 'aceptar',
						});
					});</script>";
			}
		}
	} else {
		echo "<script>$(document).ready(function() {
				swal({
				  title: 'para agregar a favoritos, debes iniciar sesion!',
				  icon: 'error',
				  button: 'aceptar',
				});
			});</script>";
	}
}


/* suscribirse */
if (isset($_POST["sus"])) {
	$email = $_POST['email_sus'];
	$Suscribe = new Suscribe($email);
	$data = $Suscribe->Suscribe();
	if ($data) {
		echo "<p class='correct'>Suscripcion exitosa. </p>";
	} else {
		echo "<p class='error'>Error al Suscribirte. </p>";
	}
}
/*cerrar session*/
if (isset($_POST['logut'])) {
	if (isset($_SESSION['u_inf'])) {
		unset($_SESSION['u_inf']);
		echo "<script>$(document).ready(function() {
				setTimeout(function() { window.location.reload();}, 1000);
			});</script>";
	}
}

/*aumentar la cantidad*/
if (isset($_POST["pmas"])) {
	$_unique_key = md5($_POST['idp']);
	if (isset($_SESSION['cart'][$_unique_key]) && ($_SESSION['cart'][$_unique_key]['unique_id'] === $_unique_key))
		$_SESSION['cart'][$_unique_key]['cantidad'] = $_SESSION['cart'][$_unique_key]['cantidad'] + 1;

	echo $_SESSION['cart'][$_unique_key]['cantidad'];
}

/*restar la cantidad */
if (isset($_POST["pres"])) {
	$_unique_key = md5($_POST['idp']);
	if (isset($_SESSION['cart'][$_unique_key]) && ($_SESSION['cart'][$_unique_key]['unique_id'] === $_unique_key))
		if ($_SESSION['cart'][$_unique_key]['cantidad'] <= 1) {
			$_SESSION['cart'][$_unique_key]['cantidad'] = 1;
		} else {
			$_SESSION['cart'][$_unique_key]['cantidad'] = $_SESSION['cart'][$_unique_key]['cantidad'] - 1;
		}
	echo $_SESSION['cart'][$_unique_key]['cantidad'];
}

function agregar_carrito($_unique_id)
{
	if (!isset($_SESSION['cart'])) {
		$_SESSION['cart'][md5($_unique_id)] = get_datos($_unique_id);
	} else {
		$_unique_key = md5($_unique_id);

		if (isset($_SESSION['cart'][$_unique_key]) && ($_SESSION['cart'][$_unique_key]['unique_id'] === $_unique_key))
			$_SESSION['cart'][$_unique_key]['cantidad'] = $_SESSION['cart'][$_unique_key]['cantidad'] + 1;
		else
			$_SESSION['cart'][md5($_unique_id)] = get_datos($_unique_id);
	}
}

function get_datos($id)
{
	$Producto = new Producto();
	$data = $Producto->ViewProducto($id);
	foreach ($data as $key => $value) {
		return array('id' => $value->id, 'unique_id' => md5($id), 'nombre' => $value->nombre, 'imagen' => $value->imagen, 'precio' => $value->precio, 'cantidad' => 1);
	}
}
function remove_cart($_unique_id)
{
	$_unique_key = md5($_unique_id);
	if (isset($_SESSION['cart'][$_unique_key])) {
		unset($_SESSION['cart'][$_unique_key]);
	}
	CountCart();
}


function ViewCart()
{
	if (isset($_SESSION['cart'])) {
		$datos = $_SESSION['cart'];
		$subtotal = 0;
		foreach ($datos as $key => $value) {
			$_html = "<div class='box_product'><div class='img-prod'><img src='img/uploads/" . $value['imagen'] . "'></div>";
			$_html .= "<div class='info-prod'><span>" . $value['nombre'] . "</span><span>Cantidad: " . $value['cantidad'] . "</span>";
			$_html .= "<span>Precio: S/. " . $value['precio'] . "</span></div></div>";
			$subtotal += (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
			echo $_html;
		}
		$_val = "<div class=box-info-pay><p>Subtotal: S/. " . $subtotal . " </p><a id='view_detail'href='./viewdetail.php'> Checkout</a></div>";
		echo $_val;
	} else {
		echo "<span>No hay datos en carrito </span>";
	}
}

function ViewPayment()
{
	if (isset($_SESSION['cart'])) {
		$datos = $_SESSION['cart'];
		$subtotal = 0;

		$details = '';
		foreach ($datos as $key => $value) {
			$details .= "<tr>
							<td class='img-cart'>
								<img src='img/uploads/" . $value['imagen'] . "' width='100'/>
							</td>
							<td>" . $value['nombre'] . "</td>
							<td> S/ " . $value['precio'] . "</td>
							<td> " . $value['cantidad'] . " </td>
							<td> S/ " . intval($value['precio']) * number_format($value['cantidad'], 2, '.', '') . "</td>
						</tr>";
			$subtotal += (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
		}

		$_html = "<div class='card-header'> Detalle de carrito </div> 
					<div class='card-body table-responsive'>
						<table class='table'>
							<thead>
								<tr>
									<th class='img-cart'> Imagen </th>
									<th> Producto </th>
									<th> Precio </th>
									<th> Cantidad </th>
									<th> Importe </th>
								</tr>
							</thead>
							<tbody>
								". $details."
								<tr>						
									<td colspan='3' class='text-right'> <strong>SubTotal</strong> </td>
									<td>S/ " . $subtotal . "</td>
								</tr>
							</tbody>
						</table>
				</div>";
		echo $_html;
	} else {
		echo "<span>No hay datos en carrito </span>";
	}
}

/*realizar pago ventas*/
if (isset($_POST['reg_pay'])) {
	if (isset($_SESSION['cart'])) {
		$carrito = $_SESSION['cart'];

		$user = $_SESSION['u_inf'];

		$Ventas = new Ventas($user['id']);
		
		$docs = new stdClass();
		$docs->fecha = date("Y-m-d H:i:s");
		$docs->codigo = $Ventas->Get_Num_Doc();
		$docs->tipo_pago = 0;
		$docs->status = 0;

		$idVenta = $Ventas->Registrar($docs);
		$fecha = date("Y-m-d H:i:s");

		foreach ($carrito as $key => $value) {
			$impo = (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
			$Detalleventa = new Detalleventa($idVenta, $value['id'], $value['nombre'], $value['cantidad'], $value['precio'], $impo, $fecha);
			$resultado = $Detalleventa->RegistrarDetalle();
		}

		if ($resultado) {
			VaciarCart();
			echo "<script>$(document).ready(function() {
					setTimeout(function() { window.location.href = './history.php';}, 1000);
				});</script>";
			exit();
		}
	} else {
		echo "<span>No hay datos en carrito </span>";
	}
}
/*listar historial ventas*/

if (isset($_POST['viewventa'])) {
	$num_rows_prod =	$Ventas->getNumRows();

	if ($num_rows_prod > 0) {
		$TAMANO_PAGINA = 10;
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

		/*lista venta*/
		$user = $_SESSION['u_inf'];
		$idcli = $user['id'];

		$data = $Ventas->Listar($inicio, $TAMANO_PAGINA, $idcli);

		$_html = "<div class='header-card'> Historial de la cuenta </div>
				<div class='card-body'>";
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$_html .= "<div class='collapsible'>";
				$_html .= "<div class='head_colapse d-flex justify-content-between align-content-center' > 
								<span> " . $value->document . " -  " . $value->fecha . " </span> 
								<i class='right fa fa-chevron-down'></i> 
							</div>";

				$res = ListarDet($value);
				$_html .= $res;
				$_html .= "</div>";
			}
		} else {
			$_html .= "<span class='smj_prod'> No hay movimientos en la cuenta </span>";
		}

		$_html .= "</div>";

		$_html .= "<div class='card-footer'><ul class='pagination'>";
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

		$_html .= "</ul></div>";
		echo $_html;
	} else {
		echo "<span class='smj_prod'> No hay registro</span>";
	}
}

function ListarVentas($init, $next)
{
	$Ventas = new Ventas();
	$data = $Ventas->Listar($init, $next);

	if ($data != 0) {
		$_html = "<div class='header-card'> Moviminetos de la cuenta </div><div class='card-body'>";

		foreach ($data as $key => $value) {
			$_html .= "<div class='collapsible'>";
			$_html .= "<div class='head_colapse'>" . $value->document . " -  " . $value->fecha . "<i class='right fa fa-chevron-down'></i></div>";
			$_html .= "</div>";
		}
		$_html .= "</div>";
	} else {
		echo "<span class='smj_prod'> Aun no hay movimientos en la cuenta</span>";
	}
	echo $_html;
}
function ListarDet($docs)
{
	$Detalleventa = new Detalleventa();
	$datos = $Detalleventa->ListarDetalle($docs->id);
	if ($datos != 0) {
		$_html = "<table class='content'>
					<thead>
						<tr>
							<th> Producto </th>
							<th> Cantidad </th>
							<th> Precio </th>
							<th> Importe </th>
						</tr>
					</thead>
					<tbody>";
		$subtotal = 0;
		foreach ($datos as $key => $valor) {
			$_html .= "<tr>
							<td> " . $valor->descripcion . " </td>
							<td class='tb-canti'> " . $valor->cantidad . " </td>
							<td> S/ " . number_format($valor->precio, 2, '.', '') . "</td> 
							<td> S/ " . intval($valor->cantidad) * number_format($valor->precio, 2, '.', '') . "</td>
						</tr>";
			$subtotal += number_format(($valor->cantidad * $valor->precio), 2, '.', '');
		}
		$_html .= "<tr> 
					<td colspan='4'></td> 					
				</tr>
				<tr>
					<td colspan='3' class='text-right'> Subtotal </td> 
					<td> S/ " . $subtotal . " </td> 
				</tr>
			</tbody></table>";
	} else {
		$_html = "<span class='smj_prod'> Aun no hay movimientos en la cuenta</span>";
	}
	return $_html;
}

/*contar cantidad de carrito*/
if (isset($_POST['count'])) {
	$cont = 0;
	if (isset($_SESSION['cart'])) {
		$datos = $_SESSION['cart'];

		foreach ($datos as $key => $value) {
			$cont += intval($value['cantidad']);
		}
	}
	echo $cont;
}
/*calcular subtotal*/
if (isset($_POST["psubt"])) {
	if (isset($_SESSION['cart'])) {
		$datos = $_SESSION['cart'];
		$subtotal = 0;
		foreach ($datos as $key => $value) {
			$subtotal += (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
		}
		echo $subtotal;
	}
}

/*vaciar carrito*/
if (isset($_POST["removeCart"])) {
	VaciarCart();
}

function VaciarCart()
{
	unset($_SESSION['cart']);
	echo "1";
}
/*realziar pago*/
if (isset($_POST['paym'])) {

	if (isset($_SESSION['u_inf'])) {
		echo json_encode(["status" => true]);
	} else {
		echo json_encode(["status" => false]);
	}
}


function CountCart()
{
	$datos = $_SESSION['cart'];
	if (count($datos) == 0) {
		unset($_SESSION['cart']);
	}
}

function ListarCart()
{
	if (isset($_SESSION['cart'])) {
		$datos = $_SESSION['cart'];

		$_html = "
			<div class='table-responsive-md w-100'>
			<table class='table table-hover'>
					<thead class='thead-light'>
						<tr>
							<th> Producto </th> 
							<th class='descrip'> </th> 
							<th> Precio </th>
							<th> Cantidad </th>
							<th class='import'> Importe </th>
							<th> Accion </th>
						</tr>
					</thead>
				<tbody>";

		$subtotal = 0;
		foreach ($datos as $key => $value) {
			$_html .= "<tr class='item_prod'>
							<td class='td-img'>
								<img src='img/uploads/" . $value['imagen'] . "'/>
							</td>
							<td class='descrip'>" . $value['nombre'] . "</td>
							<td class='td-prec'> 
								<p> S/ </p> <p class='prec'>" . $value['precio'] . "</p>
							</td>
							<td class='cant'>
								<button  class='rest' type='submit'>-</button>
								<input class='canti' type='text' disabled ='true' idval='" . $value['id'] . "' value='" . $value['cantidad'] . "'/>
								<button class='plus' type='submit'>+</button>
							</td>
							<td class='imp'>S/  " . (number_format($value['precio'] * $value['cantidad'], 2, '.', '')) . "</td>
							<td>
								<a href='#' val_trash ='" . $value['id'] . "' class='trash btn-danger'> Eliminar </a>
							</td>
						</tr>";
			$subtotal += (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
		}
		$_html .= "</tbody></table></div>
					<div class='row d-flex justify-content-between w-100 mt-2'>
						<div class='col-sm-12 col-md-6'>
							<a class='btn btn-primary mr-2 mb-2' id='continue' href='./'>Seguir Comprando</a>
							<a class='btn btn-danger mb-2' href='#' id='clean'> Vaciar carrito </a>							
						</div>
						<div class='col-sm-12 col-md-6 mb-2 d-block d-md-flex justify-content-end align-items-center'>
							<p class='nam m-0 mr-2 mb-2'> Total: 
								<span id='subt'> S/. " . $subtotal . "</span>
							</p>
							<a class='btn btn-success mb-2' href='#' id='pay_right'> Realizar Pago </a>							
						</div>
					</div>";

		echo $_html;
	} else {
		echo "<span>No hay datos en carrito </span>";
		echo "<a class='btn btn-info' id='retur' href='./'> Seguir comprando </a>";
	}
}
