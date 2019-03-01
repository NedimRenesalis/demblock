<?php
$domain = "token.demblock-tge.com";
return [
    'adminEmail' => 'support@demblock.com',
    'supportEmail' =>  'support@demblock.com',
    'user.passwordResetTokenExpire' => 3600,

    // Whitelisted domains
    'allowedDomains'  => [
        'http://'.$domain,
        'https://'.$domain
    ],

    // Machinepicker + Demblock sale config
    'CROWDSALE_DAPP_API' => "https://".$domain,
    'CROWDSALE_ITEMPOST_URL' => "https://".$domain."/list-item.html",
    'CROWDSALE_ITEMINFO_URL' => "https://".$domain."/user-items.html",
    'CROWDSALE_SALE_INFO' => "https://".$domain."/crowdsale",
    'CROWDSALE_TOKEN_INFO' => "https://".$domain."/token",

    // Static
    'CROWDSALE_USERQUERY' => "user",
    'CROWDSALE_USERQUERY_ID' => "userId",
    'CROWDSALE_USERQUERY_EXISTS' => "modelExists",
];
