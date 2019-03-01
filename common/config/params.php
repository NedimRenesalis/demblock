<?php
return [
    'adminEmail' => 'support@demblock.com',
    'supportEmail' =>  'support@demblock.com',
    'user.passwordResetTokenExpire' => 3600,
    
    // Machinepicker + Demblock sale config
    'offChainServer' => "https://token.demblock.com",
    'postItemDapp' => "https://token.demblock.com/list-item.html",
    'itemInfoDapp' => "https://token.demblock.com/user-items.html",
    'allowedDomains'  => [
        'http://token.demblock.com'
    ],

    // Static
    'userQuery' => "user",
    'userIdQuery' => "userId",
    'userExistsQuery' => "modelExists",
];
