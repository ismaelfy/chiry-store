<?php
session_start();
require_once 'includes/functions.php';
$_SESSION['active'] = 'productos';
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
                <div class="contenedor-item container bg-white py-3"></div>
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