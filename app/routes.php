<?php

return $routes = [
    '' => ['controller' => 'ProductController', 'method' => 'index'],
    'products' => ['controller' => 'ProductController', 'method' => 'viewAllProducts'],
    'product' => ['controller' => 'ProductController', 'method' => 'getProductById'],
    'login' => ['controller' => 'Auth', 'method' => 'login'],
    'register' => ['controller' => 'Auth', 'method' => 'register'],
    'sign-out' => ['controller' => 'Auth', 'method' => 'signOut'],

    'categories' => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],

    'dashboard' => ['controller' => 'Dashboard', 'method' => 'index'],
    'dashboard/home' => ['controller' => 'Dashboard', 'method' => 'index'],
    'dashboard/orders' => ['controller' => 'OrderController', 'method' => 'getAllOrders'],

    'dashboard/categories' => ['controller' => 'CategoryController', 'method' => 'dashBoardCategories'],
    'dashboard/add-new-category' => ['controller' => 'CategoryController', 'method' => 'addNew'],
    'dashboard/edit-category' => ['controller' => 'CategoryController', 'method' => 'edit'],
    'dashboard/delete-category' => ['controller' => 'CategoryController', 'method' => 'delete'],

    'dashboard/profile' => ['controller' => 'UserController', 'method' => 'profile'],
    'dashboard/wallet' => ['controller' => 'WalletController', 'method' => 'getUserWallet'],

    'dashboard/add-new-auction' => ['controller' => 'ProductController', 'method' => 'addNew'],
    'dashboard/auctions' => ['controller' => 'ProductController', 'method' => 'getAllAuctions'],

    'dashboard/users' => ['controller' => 'UserController', 'method' => 'getAllUsers'],

    'auction/delete' => ['controller' => 'ProductController', 'method' => 'deleteProduct'],
    'dashboard/auction-edit' => ['controller' => 'ProductController', 'method' => 'editProduct'],

    'auction-manage' => ['controller' => 'ProductController', 'method' => 'adminAuction'],

    'change-profile' => ['controller' => 'UserController', 'method' => 'changeProfile'],
    'reset-password' => ['controller' => 'UserController', 'method' => 'resetPassword'],

    'deposit' => ['controller' => 'WalletController', 'method' => 'deposit'],
    'withdraw' => ['controller' => 'WalletController', 'method' => 'withdraw'],
];