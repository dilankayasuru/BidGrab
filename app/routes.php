<?php

return $routes = [
    '' => ['controller' => 'HomeController', 'method' => 'index'],
    'products' => ['controller' => 'ProductController', 'method' => 'index'],
    'product' => ['controller' => 'ProductController', 'method' => 'getProductById'],
    'login' => ['controller' => 'Auth', 'method' => 'login'],
    'register' => ['controller' => 'Auth', 'method' => 'register'],
    'sign-out' => ['controller' => 'Auth', 'method' => 'signOut'],


    'dashboard' => ['controller' => 'Dashboard', 'method' => 'index'],
    'dashboard/home' => ['controller' => 'Dashboard', 'method' => 'index'],
    'dashboard/orders' => ['controller' => 'OrderController', 'method' => 'getAllOrders'],
    'dashboard/profile' => ['controller' => 'UserController', 'method' => 'profile'],
    'dashboard/wallet' => ['controller' => 'Dashboard', 'method' => 'index'],
    'dashboard/add-new-auction' => ['controller' => 'ProductController', 'method' => 'addNew'],
    'dashboard/auctions' => ['controller' => 'ProductController', 'method' => 'getAllAuctions'],

    'auction/delete' => ['controller' => 'ProductController', 'method' => 'deleteProduct'],
    'dashboard/auction-edit' => ['controller' => 'ProductController', 'method' => 'editProduct'],

    'change-profile' => ['controller' => 'UserController', 'method' => 'changeProfile'],
    'reset-password' => ['controller' => 'UserController', 'method' => 'resetPassword'],
];