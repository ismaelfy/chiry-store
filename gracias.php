<?php
session_start();
require_once 'includes/functions.php';
require 'paypal/config.php';
require_once './paypal/payments_process.php';
require_once './app/ventas.php';


if (!isset($_SESSION['payment_detail']) || empty($_SESSION['payment_detail'])) {
    header('Location: ./');
    die();
}
$payment  = $_SESSION['payment_detail'];
$payment->type = 0;
if (!$payment->success) {
    header('Location: ./');
    die();
}
/* if(!isset($payment->type)) {
    header('Location: ./');
    die();
} */
$ventas = new Ventas();
$apiContext = getApiContext();

$Process = new Processing($apiContext);
$user = $_SESSION['u_inf'];

if (isset($_GET['success']) && $_GET['success'] == 'true') {
    $data = (object)$_GET;
    if ($payment->type == 1) {
        $update = [
            "confirm" => 1,
            "payment_method" => $payment->payment_method
        ];
        $res = $ventas->update($update, $payment->id_venta);
    }
    if ($payment->type == 0) {
        $errors = 0;
        $errors = ($payment->success) ?  +0 : +1;
        $errors = ($payment->paymentId == $data->paymentId) ? +0 : +1;
        $errors = ($payment->paymentId == '' && $data->paymentId == '') ? +0 : +1;
        $errors = ($data->PayerID != '') ? +0 : +1;
        $errors = ($data->token != '') ? +0 : +1;

        if ($errors == 0) {
            $payData = (object)["paymentId" => $payment->paymentId, "PayerID" => $data->PayerID];

            $pay = $Process->execute_payment($payData);
            if ($pay->state == 'approved') {
                $datos = [
                    "tipo_pago" => $payment->type,
                    "invoice_number" => $payment->invoice_number,
                    "payment_id" => $payment->paymentId,
                    "payment_method" => $payment->pay_method,
                    "payer_id" => $data->PayerID,
                    "payment_token" => $data->token,
                    "confirm" => 1,
                    "status" => 1
                ];
                $ventas->update($datos, $payment->id_venta);
            } else {
                header('Location: ./fail?success=false');
                die();
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Carrito de compras </title>
    <?php display_link(); ?>
</head>

<body>
    <?php display_header() ?>
    <!-- visualizar carrito -->
    <section class="p-0 h-50">
        <div class="container py-5">
            <div class="row pt-3">
                <div class="col-sm-12">
                    <h3> Su compra se realizó exitosamente.</h3>
                </div>
            </div>
        </div>
    </section>

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