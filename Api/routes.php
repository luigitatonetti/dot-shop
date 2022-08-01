<?php

return $routes = [
    'GET' => [
        'orders' => 'OrdersController@readAll',
        'products' => 'ProductsController@readAll',
        'product' => 'ProductsController@read'
    ],
    'PUT' => [
        'product' => 'ProductsController@update'
    ],
    'POST' => [
        'createOrder' => 'OrdersController@create',
        'readOrder' => 'OrdersController@read',
        'createUser' => 'UsersController@create',
        'readUser' => 'UsersController@read'
    ],
    'DELETE' => [
        'order' => 'OrdersController@delete'
    ]
];