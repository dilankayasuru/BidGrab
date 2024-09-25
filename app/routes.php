<?php

return $routes = [

    // Auth routes
    '' => ['controller' => 'ProductController', 'method' => 'index'],
    'login' => ['controller' => 'Auth', 'method' => 'login'],
    'register' => ['controller' => 'Auth', 'method' => 'register'],
    'sign-out' => ['controller' => 'Auth', 'method' => 'signOut'],

    // Route to view auctions
    'products' => ['controller' => 'ProductController', 'method' => 'viewAllProducts'],
    'product' => ['controller' => 'ProductController', 'method' => 'getProductById'],

    // Route to view categories
    'categories' => ['controller' => 'CategoryController', 'method' => 'getAllCategories'],

    // Dashboard routes
    'dashboard' => ['controller' => 'DashboardController', 'method' => 'index'],
    'dashboard/home' => ['controller' => 'DashboardController', 'method' => 'index'],
    'dashboard/orders' => ['controller' => 'OrderController', 'method' => 'getAllOrders'],

    // Dashboard category routes
    'dashboard/categories' => ['controller' => 'CategoryController', 'method' => 'dashBoardCategories'],
    'dashboard/add-new-category' => ['controller' => 'CategoryController', 'method' => 'addNew'],
    'dashboard/edit-category' => ['controller' => 'CategoryController', 'method' => 'edit'],
    'dashboard/delete-category' => ['controller' => 'CategoryController', 'method' => 'delete'],

    // Dashboard user routes
    'dashboard/profile' => ['controller' => 'UserController', 'method' => 'profile'],
    'dashboard/wallet' => ['controller' => 'WalletController', 'method' => 'getUserWallet'],
    'dashboard/transactions' => ['controller' => 'TransactionController', 'method' => 'index'],
    'dashboard/users' => ['controller' => 'UserController', 'method' => 'getAllUsers'],

    // Dashboard auction routes
    'dashboard/add-new-auction' => ['controller' => 'ProductController', 'method' => 'addNew'],
    'dashboard/auctions' => ['controller' => 'ProductController', 'method' => 'getAllAuctions'],
    'dashboard/auction-edit' => ['controller' => 'ProductController', 'method' => 'editProduct'],

    // Auction management routes
    'auction/delete' => ['controller' => 'ProductController', 'method' => 'deleteProduct'],
    'auction-manage' => ['controller' => 'ProductController', 'method' => 'adminAuction'],

    // User profile routes
    'change-profile' => ['controller' => 'UserController', 'method' => 'changeProfile'],
    'reset-password' => ['controller' => 'UserController', 'method' => 'resetPassword'],

    // Wallet routes
    'deposit' => ['controller' => 'WalletController', 'method' => 'deposit'],
    'withdraw' => ['controller' => 'WalletController', 'method' => 'withdraw'],

    // User activation routes
    'user/activate' => ['controller' => 'UserController', 'method' => 'activate'],
    'user/deactivate' => ['controller' => 'UserController', 'method' => 'deactivate'],

    // User registration route
    'register/user' => ['controller' => 'UserController', 'method' => 'addNew'],

    // Order submit and transaction init routes
    'order/submit' => ['controller' => 'OrderController', 'method' => 'submitOrder'],
    'order/manage' => ['controller' => 'OrderController', 'method' => 'manageOrder'],
];