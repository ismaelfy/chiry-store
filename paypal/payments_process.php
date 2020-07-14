<?php

use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;

class Processing
{
    private $apiContext;
    public function __construct($context = null)
    {
        $this->apiContext = $context;
    }
    public function create_payment()
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $subtotal = 0.01;
        $details = [];
        /* foreach ($_SESSION['cart'] as $key => $value) {
            $item = new Item();
            $item->setName($value['nombre'])
                ->setCurrency(MONEDA)
                ->setQuantity($value['cantidad'])
                ->setSku("123123")
                ->setPrice($value['precio']);
            $details[] = $item;
            $subtotal += $value['precio'] * $value['cantidad'];
        } */
        $item = new Item();
        $item->setName("descripcion")
            ->setCurrency(MONEDA)
            ->setQuantity(1)
            ->setSku("123123")
            ->setPrice(0.01);
        $details[] = $item;

        $itemList = new ItemList();
        $itemList->setItems($details);

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($subtotal);

        $amount = new Amount();
        $amount->setCurrency(MONEDA)
            ->setTotal($subtotal)
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description - chiry")
            ->setInvoiceNumber(uniqid());

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(BASE_URL . "gracias?success=true")
            ->setCancelUrl(BASE_URL . "fail?success=false");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        $request = clone $payment;
        try {
            $payment->create($this->apiContext);
        } catch (Exception $ex) {
            $data = new stdClass();
            $data->erro = $ex;
            $data->success = false;
            $data->msg = "error occurred while creating payment.";
            return $data;
        }
        $approvalUrl = $payment->getApprovalLink();
        $payment = json_decode($payment);
        $request = json_decode($request);

        $data = new stdClass();
        $data->success = true;
        $data->msg = "payment created successful.";
        $data->links = $approvalUrl;
        $data->paymentId = $payment->id;
        $data->invoice_number = $payment->transactions[0]->invoice_number;
        $data->pay_method = $payment->payer->payment_method;

        return $data;
        //$_SESSION['payment_detail'] = $data;


    }
    public function execute_payment($data)
    {
        $paymentId = $data->paymentId;
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($data->PayerID);

        $transaction = new Transaction();
        $amount = new Amount();

        $subtotal = 0.01;

        /* foreach ($_SESSION['cart'] as $key => $value) {            
            $subtotal += $value['precio'] * $value['cantidad'];
        } */

        $details = new Details();
        $details->setShipping(0)
            ->setTax(0)
            ->setSubtotal($subtotal);

        $amount->setCurrency(MONEDA);
        $amount->setTotal($subtotal);
        $amount->setDetails($details);
        $transaction->setAmount($amount);
        $execution->addTransaction($transaction);

        try {
            $result = $payment->execute($execution, $this->apiContext);            
            try {
                $payment = Payment::get($paymentId, $this->apiContext);
            } catch (Exception $ex) {
                echo "erro 1 \n";
                print_r(["Get Payment", "Payment", null, null, $ex]);
                exit(1);
            }
        } catch (Exception $ex) {
            echo "erro 2 \n";
            print_r(["Executed Payment", "Payment", null, null, $ex]);
            exit(1);
        }
        //print_r(["Get Payment", "Payment", $payment->getId(), null, $payment]);

        return json_decode($payment);
    }
}
