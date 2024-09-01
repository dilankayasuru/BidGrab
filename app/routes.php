<?php

return $routes = [
    '' => ['controller' => 'HomeController', 'method' => 'index'],
    'products' => ['controller' => 'Product', 'method' => 'index'],
    'product/view' => ['controller' => 'Product', 'method' => 'getProductById'],
];