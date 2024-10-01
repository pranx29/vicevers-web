<?php

$routes = [
    // Home route
    '' => ['controller' => 'HomeController', 'method' => 'index'],

    // Product routes
    'products' => ['controller' => 'ProductController', 'method' => 'index'],
    'products/mens-wear' => ['controller' => 'ProductController', 'method' => 'mensProducts'],
    'products/womens-wear' => ['controller' => 'ProductController', 'method' => 'womensProducts'],
    'product' => ['controller' => 'ProductController', 'method' => 'getProduct'],
    'products/details' => ['controller' => 'ProductController', 'method' => 'details'],
    'products/add' => ['controller' => 'ProductController', 'method' => 'add'],
    'products/add-variant' => ['controller' => 'ProductVariantController', 'method' => 'addVariant'],
    'products/edit' => ['controller' => 'ProductController', 'method' => 'edit'],
    'products/category' => ['controller' => 'CategoryController', 'method' => 'index'],
    'products/color' => ['controller' => 'ColorController', 'method' => 'index'],
    'products/size' => ['controller' => 'SizeController', 'method' => 'index'],
    'products/add-discount' => ['controller' => 'ProductController', 'method' => 'addDiscount'],
    'variant/update' => ['controller' => 'ProductVariantController', 'method' => 'updateQuantity'],

    // Cart routes
    'cart' => ['controller' => 'CartController', 'method' => 'index'],
    'cart/add' => ['controller' => 'CartController', 'method' => 'add'],
    'cart/remove' => ['controller' => 'CartController', 'method' => 'remove'],
    'cart/update' => ['controller' => 'CartController', 'method' => 'update'],

    // Order routes
    'orders' => ['controller' => 'OrderController', 'method' => 'index'],
    'orders/details' => ['controller' => 'OrderController', 'method' => 'details'],
    'orders/update' => ['controller' => 'OrderController', 'method' => 'updateStatus'],

    // Checkout routes
    'checkout' => ['controller' => 'CheckoutController', 'method' => 'index'],
    'checkout/cart' => ['controller' => 'CheckoutController', 'method' => 'checkout'],

    // Admin routes
    'admin' => ['controller' => 'AdminController', 'method' => 'index'],
    'admin/login' => ['controller' => 'AdminController', 'method' => 'login'],
    'admin/logout' => ['controller' => 'AdminController', 'method' => 'logout'],

    // Category routes
    'category/add' => ['controller' => 'CategoryController', 'method' => 'add'],

    // Color routes
    'color/add' => ['controller' => 'ColorController', 'method' => 'add'],

    // Size routes
    'size/add' => ['controller' => 'SizeController', 'method' => 'add'],

    // Customer routes
    'customers' => ['controller' => 'UserController', 'method' => 'index'],
    'customer/status' => ['controller' => 'UserController', 'method' => 'changeStatus'],

    // Account routes
    'account' => ['controller' => 'AccountController', 'method' => 'account'],
    'account/login' => ['controller' => 'AccountController', 'method' => 'login'],
    'account/register' => ['controller' => 'AccountController', 'method' => 'register'],
    'account/logout' => ['controller' => 'AccountController', 'method' => 'logout'],
    'account/orders' => ['controller' => 'AccountController', 'method' => 'orders'],
    'account/order-detail' => ['controller' => 'AccountController', 'method' => 'orderDetails'],
    'account/update' => ['controller' => 'AccountController', 'method' => 'update'],
    'account/add-address' => ['controller' => 'AccountController', 'method' => 'addAddress'],

    // Contact routes
    'contact' => ['controller' => 'ContactController', 'method' => 'index'],
];