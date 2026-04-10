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

$routes->get('sales', 'Sales::index'); // /sales → SalesController::index

// Logs
$routes->get('/log', 'Logs::log');