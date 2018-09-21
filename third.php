<?php

require __DIR__  . '/vendor/autoload.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AWBFTZ8yFRwJVvztHWY4catN_-oj1D11tsgoTytcb754gh2T9KezdV4Qlmy8WOJfNR_u9DoH_VAMqu7r',     // ClientID
        'EGS3ZHee-BE6In6oXHh35mHZ4jsRqKCL0BzUxlsP_xDug53VQLmaMIjV2NatvlolUUOByJqrdVL8nKtM'      // ClientSecret
    )
);

$apiContext->setConfig(
    array(
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG',
        'mode' => 'live'
    )
);

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("123123")// Similar to `item_number` in Classic API
    ->setPrice(0.1);


$itemList = new ItemList();
$itemList->setItems(array($item1));

$details = new Details();

$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(1)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$baseUrl = "http://localhost/zaposljavanje";
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("$baseUrl/second.php?success=true")
    ->setCancelUrl("$baseUrl/second.php?success=false");


$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (Exception $ex) {

    var_dump("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
    exit(1);

}

$approvalUrl = $payment->getApprovalLink();

var_dump("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;