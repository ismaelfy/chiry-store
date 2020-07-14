
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Sistema de venats</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="../css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/scroll.css">
</head>
<body>

<div class="modal">
	<div class="conte-modal"></div>
</div>

<section class="main">

	<!-- header vertical -->
	<div class="header-nav">
		<div class="log">
			<a href="./"><img src="../img/logo.png"></a>
		</div>
		<div class="nav-menu">			
			<nav class="contenedor-menu">
				<a href="#" class="bt-menu"><i class="left fa fa-bars"></i> Menu</a>
				<ul class="menu">
					<li class="item"><a href="#"> <i class="left fa fa-home"></i> Inicio</a></li>
					<li class="item active">
						<a href="#"> <i class="left fa fa-user"></i> Almacen  <i class="right fa fa-chevron-down"></i></a>
						<ul class="children">
							<li><a href="#"> category </a></li>
							<li class="addproduct"><a href="#"> Product </a></li>
							<li><a href="#"> Tienda </a></li>
						</ul>
					</li>
					<li class="item">
						<a href="#"> <i class="left fa fa-user"></i> Facturacion <i class="right fa fa-chevron-down"></i></a>
						<ul class="children">
							<li><a href="#"> Factura</a></li>
							<li><a href="#"> Boleta </a></li>
							<li><a href="#"> Caja </a></li>
						</ul>
					</li>
					<li class="item"><a href="#"> <i class="left fa fa-user"></i> Servicios <i class="right fa fa-chevron-down"></i></a>
						<ul class="children active">
							<li><a href="#">SubElemento #1</a></li>
							<li><a href="#">SubElemento #2</a></li>
							<li><a href="#">SubElemento #3</a></li>
						</ul>
					</li>
					<li class="item"><a href="#"> <i class="left fa fa-user"></i> Contacto</a></li>
				</ul>
			</nav>
		</div>

	</div>

	<!-- nav bar user info -->
	<div class="nav-bar">
		<div class="container-box">

			<div class="box-info">
				<div class="cont message">
					<i class="fa fa-comments"></i>
				</div>
				<div class="cont notify">
					<i class="fa fa-bell"></i>
				</div>
				<div class="cont email">
					<i class="fa fa-envelope"></i>
				</div>
				<div class="cont user-box">
					<img src="../img/user.png" width="40" alt="40">					
				</div>

			</div>

		</div>
		
	</div>
	

	<!-- contenedor de items -->
	<div class="sms"></div>
	<div class="contenedor-item">
		<div class='card product'><div class='header-card'><strong>Registrar producto</strong></div><div class='card-body'>
		 <form id='new_product' method='POST' enctype='multipart/form-data'><div class='form-group'>
		 <label> Nombre Producto </label><input type='text' name='nombre' required class='form-control' placeholder='Nombre'>
		 </div><div class='form-group'><label> Descripcion </label>
		 <textarea name='descripcion' class='form-control' required rows='3' placeholder='descripcion de articulo'></textarea>
		 </div><div class='form-group'><div class='col-2 left'><label for='precio'> Precio </label>
		 <input type='text' name='precio' required class='form-control' placeholder='0.00'></div><div class='col-2 rigth'>
		 <label for='stock'> Stock </label><input type='text' name='stock' required class='form-control' placeholder='0'>
		 </div></div><div class='form-group'><div class='col-2 left'><label for='category'> Categoria </label>
		 <select required selected name='category'><option value=''>  --- Seleccinar ---  </option>
		
		
			 <option value='$value->id'> $value->nombre</option>
		
		 </select></div><div class='col-2 rigth'><input type='checkbox' id='oferta' name='oferta' value='1'>
		 <label class='check' for='oferta'> Oferta </label></div></div>
		 <div class='form-group'><input type='file' required name='foto' value=' accept='image/*' placeholder='Examinar'>
		 </div><input type='submit'  value='Guardar' class='save_prod btn btn-primary'></form></div>
		</div>
		
			
	</div>
	
</section>

<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/sweetAlert.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="action.js" type="text/javascript"></script>

</body>
</html>
