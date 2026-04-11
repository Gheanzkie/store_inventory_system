<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::index');
$routes->get('/login', 'Auth::index');
$routes->post('/auth', 'Auth::auth');
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/logout', 'Auth::logout');

// Admin users
$routes->get('/users', 'Users::index');
$routes->post('users/save', 'Users::save');
$routes->get('users/edit/(:segment)', 'Users::edit/$1');
$routes->post('users/update', 'Users::update');
$routes->delete('users/delete/(:num)', 'Users::delete/$1');
$routes->post('users/fetchRecords', 'Users::fetchRecords');
// Products
$routes->get('/product', 'Product::index');
$routes->post('product/save', 'Product::save');
$routes->get('product/edit/(:segment)', 'Product::edit/$1');
$routes->post('product/update', 'Product::update');
$routes->delete('product/delete/(:num)', 'Product::delete/$1'); 
$routes->post('product/fetchRecords', 'Product::fetchRecords');


$routes->group('sales_items', function($routes) {
    $routes->get('/', 'Sales_Items::index');
    $routes->post('save', 'Sales_Items::save');
    $routes->post('delete', 'Sales_Items::delete');
});

$routes->group('sales', function($routes) {
    $routes->get('/', 'Sales::index');
    $routes->post('create', 'Sales::create');
    $routes->post('checkout', 'Sales::checkout');
});

$routes->post('sales/delete', 'Sales::delete');

// Logs
$routes->get('/log', 'Logs::log');