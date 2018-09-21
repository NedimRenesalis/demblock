<?php
require __DIR__  . '/vendor/autoload.php';

use PayPal\Api\ExecutePayment;



if (isset($_GET['success']) && $_GET['success'] == 'true') {


    var_dump("Payment finished using Sandbox");

} else {
    var_dump("User Cancelled the Approval", null);
    exit;

}