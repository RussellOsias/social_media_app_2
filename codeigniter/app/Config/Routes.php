<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load system routes if available
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// Set default namespace, controller, method
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

// Define routes
$routes->match(['get', 'post'], '/', 'Auth::index'); // Home or Login Page
$routes->match(['get', 'post'], '/register', 'Auth::register'); // Registration Page
$routes->get('/login', 'Auth::index'); // Login Page
$routes->get('/welcome', 'Auth::welcome'); // Welcome Page
$routes->post('/update', 'Auth::update'); // Update User Information
$routes->get('/logout', 'Auth::logout'); // Logout Page
$routes->get('image/(:any)', 'ImageController::profile_picture/$1');

// Additional routes
$routes->get('deneme', 'Deneme::index');
$routes->get('dashboard', 'Dashboard::index');

// Load environment-specific routes if available
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
