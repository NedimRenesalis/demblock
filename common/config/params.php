<?php
return [
    'adminEmail' => 'support@demblock.com',
    'supportEmail' =>  'support@demblock.com',
    'user.passwordResetTokenExpire' => 3600,
    
    // Machinepicker + Demblock sale config
    'offChainServer' => "https://token.demblock-tge.com",
    'postItemDapp' => "https://token.demblock-tge.com/list-item.html",
    'itemInfoDapp' => "https://token.demblock-tge.com/user-items.html",
    'allowedDomains'  => [
        'http://token.demblock-tge.com',
        'https://token.demblock-tge.com'
    ],

    // Static
    'userQuery' => "user",
    'userIdQuery' => "userId",
    'userExistsQuery' => "modelExists",
];
