<?php
session_start();
require_once 'includes/functions.php';
$_SESSION['active'] = 'pedidos';

if (isset($_SESSION['user_inf'])) {
	/*$user = $_SESSION['u_inf'];
		echo $user['id'];*/
?>
	<!DOCTYPE html>
	<html>

	<head>

		<title>chiry - dashboard </title>
		<?php display_link(); ?>
	</head>

	<body>
		<div class="modal">
			<div class="conte-modal"></div>
		</div>
		<section class="main">
			<?php display_header(); ?>
			<div class="content">
				<div class="container bg-white p-3">
					<div class="row">
						<div class="col-sm-4 mb-3">
							<h4> Lista de Pedidos </h4>
						</div>

						<div class="col-sm-12">
							<div class="grid mh-100 table-responsive pb-3">
								<table id="table" class="table table-hover">
									<thead class="thead-light">
										<tr>
											<th class="details-control"></th>
											<th>N°</th>
											<th> Documento </th>
											<th> Fecha </th>
											<th> Cliente </th>
											<th> Dirección </th>
											<th> Telefono </th>
											<th> Correo </th>
											<th> pago </th>
											<th> estado </th>
											<th> Acciones </th>
										</tr>
									</thead>
									<tbody id="grid-body">
										<?php for ($i = 0; $i < 2; $i++) : ?>
											<tr>
												<td>N°</td>
												<td> Documento </td>
												<td> Fecha </td>
												<td> Cliente </td>
												<td> Dirección </td>
												<td> Telefono </td>
												<td> pago </td>
												<td> estado </td>
												<td> Acciones </td>
											</tr>
										<?php endfor; ?>
									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
		</section>

		<?php display_scripts(); ?>
	</body>

	</html>
<?php
} else {
	header('location: sign');
}
?>