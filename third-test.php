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
        'AfuFMTXoD8zvc0aShm8vbs5QKmfWbWsXKqGAAXfCoqUiCiAh3-q4Qy4UtSCRP8rONA43fLiN10wMYEGN',     // ClientID
        'EFQZJ88U10qf9CQFlFZ23S4hIzB9m9FmqTLwOpA8KuonE0dFDr7EgmrcNF1eURsD7GNl1DoQBhzEq7DR'      // ClientSecret
    )
);

$apiContext->setConfig(
    array(
        'log.LogEnabled' => true,
        'log.FileName' => 'PayPal.log',
        'log.LogLevel' => 'DEBUG',
        'mode' => 'sandbox'
    )
);

$payer = new Payer();
$payer->setPaymentMethod("paypal");

$item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setSku("123123")// Similar to `item_number` in Classic API
    ->setPrice(1);


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

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://localhost/zaposljavanje/second.php?success=true")
    ->setCancelUrl("http://localhost/zaposljavanje/second.php?success=false");


$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (PayPal\Exception\PayPalConnectionException $ex) {
    echo $ex->getCode(); // Prints the Error Code
    echo $ex->getData(); // Prints the detailed error message
    die($ex);
} catch (Exception $ex) {
    die($ex);
}


$approvalUrl = $payment->getApprovalLink();

var_dump("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

return $payment;