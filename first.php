<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
// Used for composer based installation
require __DIR__  . '/vendor/autoload.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\FundingInstrument;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentCard;
use PayPal\Api\Transaction;
// Use below for direct download installation
// require __DIR__  . '/PayPal-PHP-SDK/autoload.php';
// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
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

$card = new PaymentCard();
$card->setType("visa")
    ->setNumber("4669424246660779")
    ->setExpireMonth("11")
    ->setExpireYear("2019")
    ->setCvv2("012")
    ->setFirstName("Joe")
    ->setBillingCountry("US")
    ->setLastName("Shopper");

$fi = new FundingInstrument();
$fi->setPaymentCard($card);
$payer = new Payer();
$payer->setPaymentMethod("credit_card")
    ->setFundingInstruments(array($fi));

$item1 = new Item();
$item1->setName('Granola bars')
    ->setDescription('Granola Bars with Peanuts')
    ->setCurrency('USD')
    ->setQuantity(1)
    ->setTax(0.01)
    ->setPrice(0.01);

$itemList = new ItemList();
$itemList->setItems(array($item1));

$details = new Details();
$details->setShipping(0.01)
    ->setTax(0.01)
    ->setSubtotal(0.01);

$amount = new Amount();
$amount->setCurrency("USD")
    ->setTotal(0.03)
    ->setDetails($details);

$transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

$payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setTransactions(array($transaction));
$request = clone $payment;

try {
    $payment->create($apiContext);
} catch (Exception $ex) {

    var_dump('Create Payment Using Credit Card. If 500 Exception, try creating a new Credit Card using <a href="https://www.paypal-knowledge.com/infocenter/index?page=content&widgetview=true&id=FAQ1413">Step 4, on this link</a>, and using it.', 'Payment', null, $request, $ex);
    exit(1);
}


var_dump('Create Payment Using Credit Card', 'Payment', $payment->getId(), $request, $payment);

return $payment;