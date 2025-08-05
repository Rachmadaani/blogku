<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', function () {
    return redirect()->to('/index');
});
$routes->get('/index', 'Post::index');
$routes->get('/', 'Post::index');
$routes->get('create', 'Post::create');
$routes->post('store', 'Post::store');
$routes->get('post', 'Post::index');
$routes->get('post/view/(:segment)', 'Post::view/$1');
$routes->get('post/edit/(:num)', 'Post::edit/$1');
$routes->post('post/update/(:num)', 'Post::update/$1');
$routes->get('post/delete/(:num)', 'Post::delete/$1');

// USER
$routes->get('dashboard', 'UserController::index');
