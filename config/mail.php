<?php

return [

    'driver' => env('MAIL_DRIVER', 'smtp'),
    'host' => env('MAIL_HOST', 'smtp.qq.com'),
    'port' => env('MAIL_PORT', 465),
    'from' => [
        'address' => '929407250@qq.com',
        'name' => '李明霞',
    ],
    'encryption' => env('MAIL_ENCRYPTION', 'ssl'),
    'username' => env('MAIL_USERNAME'),
    'password' => env('MAIL_PASSWORD'),
    'pretend' => false,

];
