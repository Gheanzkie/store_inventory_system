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




// Sales Items Routes
$routes->get('sales_items', 'Sales_Items::index');
$routes->post('sales_items/save', 'Sales_Items::save');
$routes->post('sales_items/update', 'Sales_Items::update');
$routes->post('sales_items/delete', 'Sales_Items::delete');
$routes->post('sales_items/checkout', 'Sales_Items::checkout');
$routes->get('sales_items/new', 'Sales_Items::newTransaction');
$routes->get('sales_items/receipt_page/(:num)', 'Sales_Items::receipt_page/$1');
$routes->get('sales_items/receipt/(:num)', 'Sales_Items::receipt/$1');

// Sales Routes
$routes->get('sales', 'Sales::index');
$routes->post('sales/delete', 'Sales::delete');
$routes->get('sales/view/(:num)', 'Sales::view/$1');

// Logs
$routes->get('/log', 'Logs::log');