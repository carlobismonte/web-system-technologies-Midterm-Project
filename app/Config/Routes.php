<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
#$routes->get('/', 'home::index');
$routes->get('/', 'Home1::index');
$routes->get('/tasks', 'Tasks::index');
$routes->get('/profile', 'Profile::index');
$routes->get('/about', 'About::index');
$routes->get('/world1', 'world2::index');
#$routes->get('/', 'Pages::index');
#$routes->get('/about', 'Pages::about');
$routes->get('/customers', 'Customers::index', ['filter' => 'auth']);
$routes->get('/users', 'Users::index', ['filter' => 'auth']);

$routes->get('customers/new', 'Customers::create', ['filter' => 'auth']);
$routes->get('customers/create', 'Customers::create', ['filter' => 'auth']);
$routes->post('customers/store', 'Customers::store', ['filter' => 'auth']);
$routes->get('customers/edit/(:num)', 'Customers::edit/$1', ['filter' => 'auth']);
$routes->post('customers/update/(:num)', 'Customers::update/$1', ['filter' => 'auth']);

$routes->get('users/new', 'Users::create', ['filter' => 'auth']);
$routes->get('users/create', 'Users::create', ['filter' => 'auth']);
$routes->post('users/store', 'Users::store', ['filter' => 'auth']);
$routes->get('users/edit/(:num)', 'Users::edit/$1', ['filter' => 'auth']);
$routes->post('users/update/(:num)', 'Users::update/$1', ['filter' => 'auth']);

$routes->get('/login', 'Login::index');
$routes->post('/login/authenticate', 'Login::authenticate');
$routes->get('/logout', 'Login::logout');