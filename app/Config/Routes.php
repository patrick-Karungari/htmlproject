<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->add('dashboard', '\App\Controllers\Admin\Admin::index');
$routes->add('logout', '\App\Controllers\Auth::logout');
$routes->add('email', '\App\Controllers\Admin\Email::index');
$routes->add('chat', '\App\Controllers\Admin\Chat::index');
$routes->add('users', '\App\Controllers\Admin\Users::index');
$routes->add('edit/(:any)', '\App\Controllers\Admin\Users::edit/$1');
$routes->add('view/(:any)', '\App\Controllers\Admin\Users::view/$1');
$routes->add('plans/edit/(:any)', '\App\Controllers\Admin\Plans::edit/$1');
$routes->add('plans', '\App\Controllers\Admin\Plans::index');
$routes->add('profile', '\App\Controllers\Admin\Profile::index');
$routes->add('withdraws', '\App\Controllers\Admin\Withdraws::index');
$routes->add('deposits', '\App\Controllers\Admin\Deposits::index');
$routes->add('investments', '\App\Controllers\Admin\Investments::index');
$routes->add('user/investments', '\App\Controllers\User\Invest::Investments');
$routes->add('coming-soon', '\App\Controllers\Auth::comingsoon');
$routes->add('terms', '\App\Controllers\Auth::terms');





$route['auth'] = 'auth/mail_verify';


//$routes->add('user', '\App\Controllers\User\Account::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
