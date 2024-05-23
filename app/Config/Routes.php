<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes homeView   
 */
$routes->get('/', 'HomeController::loginPage');
$routes->post('/registerUser', 'HomeController::registerUser');
$routes->post('/editUserData', 'HomeController::editUserData');
$routes->post('/login', 'HomeController::login');
$routes->get('/editProfileView', 'HomeController::editProfileView');
$routes->get('/homeView', 'HomeController::homeView');
$routes->get('/changePasswordView', 'HomeController::changePasswordView');
$routes->post('/changePassword', 'HomeController::changePassword');
