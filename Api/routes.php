<?php

return $routes = [
    'GET' => [
        'products' => 'ProductsController@read',
        'orders/:id' => 'OrdersController@read',
    ],
    'PUT' => [
        'products' => 'ProductsController@update'
    ],
    'POST' => [
        'orders' => 'OrdersController@create',
        'createUser' => 'UsersController@create',
        'readUser' => 'UsersController@read'
    ],
    'DELETE' => [
        'orders/:id' => 'OrdersController@delete'
    ]
];