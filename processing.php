<?php
session_start();
require 'paypal/config.php';
require_once './paypal/payments_process.php';
require_once './app/ventas.php';
$apiContext = getApiContext();

$Process = new Processing($apiContext);
$user = $_SESSION['u_inf'];
$Ventas = new Ventas();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $body = json_decode(file_get_contents('php://input'));
    if (isset($body->action) && $body->action != '') {
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            return sendData(["data" => null, "success" => false, "msg" => "No hay productos en el carrito", "url" => BASE_URL]);
        }
        $carrito = $_SESSION['cart'];
        switch ($body->action) {
            case 'created': {
                    if ($body->type == 0) { // payment with paypal
                        $res = $Process->create_payment();
                        if ($res->success) {
                            $docs = [
                                "fecha" => date("Y-m-d H:i:s"),
                                "id_cli" => $user['id'],
                                "ndoc" => $Ventas->Get_Num_Doc(),
                                "tipo_pago" => 0,
                                "status" => 0
                            ];
                            $idVenta = $Ventas->save($docs);
                            foreach ($carrito as $key => $value) {
                                $impo = (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
                                $details = [
                                    "id_venta" => $idVenta,
                                    "idprod" => $value['id'],
                                    "descripcion" => $value['nombre'],
                                    "cantidad" => $value['cantidad'],
                                    "precio" => $value['precio'],
                                    "importe" => $impo,
                                ];
                                $Ventas->save_detail($docs);
                            }
                            $res->id_venta = $idVenta;
                            $res->type = $body->type;
                            $_SESSION['payment_detail'] = $res;
                            $data = [
                                "url" => $res->links,
                                "type" => $body->type
                            ];
                            return sendData(["data" => $data, "success" => $res->success, "msg" => $res->msg, "url" => $res->links]);
                        }
                        $data = (object) ["type" => $body->type, "success" => false];
                        $_SESSION['payment_detail'] = $data;

                        return sendData(["data" => $data, "success" => false, "msg" => $res->msg, "url" => BASE_URL . "fail?success=false"]);
                    }
                    if ($body->type == 1) { // payment default
                        $docs = [
                            "fecha" => date("Y-m-d H:i:s"),
                            "id_cli" => $user['id'],
                            "ndoc" => $Ventas->Get_Num_Doc(),
                            "tipo_pago" => 0,
                            "status" => 0
                        ];
                        $idVenta = $Ventas->save($docs);
                        if ($idVenta) {
                            foreach ($carrito as $key => $value) {
                                $impo = (intval($value['precio']) * number_format($value['cantidad'], 2, '.', ''));
                                $details = [
                                    "id_venta" => $idVenta,
                                    "idprod" => $value['id'],
                                    "descripcion" => $value['nombre'],
                                    "cantidad" => $value['cantidad'],
                                    "precio" => $value['precio'],
                                    "importe" => $impo,
                                ];
                                $Ventas->save_detail($docs);
                            }
                            $data = (object) [
                                "type" => $body->type,
                                "success" => true,
                                "id_venta" => $idVenta,
                                "payment_method" => "pedido"
                            ];

                            $_SESSION['payment_detail'] = $data;
                            return sendData(["data" => $data, "success" => true, "url" => BASE_URL . "gracias?success=true", "msg" => "se guarado su pedido"]);
                        }
                        return sendData(["data" => null, "success" => false, "msg" => "ocurrio error al guardar el pedido", "url" => BASE_URL . "fail?success=false"]);
                    }
                    $res = $Process->create_payment();
                }
        }


        //return sendData(["url" => $approvalUrl, "success" => true]);
        //return sendData(["url" => $approvalUrl, "success" => true]);
    } else {
        $_SESSION['payment_detail'] = '';
        return sendData(["data" => null, "success" => false, "msg" => 'undefinite action on request']);
    }
}
return sendData(["data" => null, "success" => false, "msg" => 'the request is invalid']);
