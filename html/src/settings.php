<?php

return [
    'apiCat'=>[
        'url'=>'https://api.thecatapi.com/v1/',
        'apiKey'=>'f8c4039c-f142-40eb-bd8e-e4b120fd7f96'
    ],

    'test_token'=>"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzZXJ2aWNlIjoiYXBpX2NhdHMifQ.NPRMrNtp9IES37mzj0x_kK-snIlbH46EiQwIMaGAovU",

	'settings'=>[
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => '172.17.0.1',
            'database' => 'cats',
            'username' => 'root',
            'password' => '123456',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ]
];