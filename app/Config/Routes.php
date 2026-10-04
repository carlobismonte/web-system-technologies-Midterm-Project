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
$routes->get('/customers', 'Customers::index');
$routes->get('/users', 'Users::index');
$routes->get('customers', 'Customers::index');

$routes->get('customers/new', 'Customers::create');
$routes->get('customers/create', 'Customers::create');
$routes->post('customers/store', 'Customers::store');
$routes->get('customers/edit/(:num)', 'Customers::edit/$1');
$routes->post('customers/update/(:num)', 'Customers::update/$1');

$routes->get('users/new', 'Users::create');
$routes->get('users', 'Users::index');
$routes->get('users/create', 'Users::create');
$routes->post('users/store', 'Users::store');
$routes->get('users/edit/(:num)', 'Users::edit/$1');
$routes->post('users/update/(:num)', 'Users::update/$1');