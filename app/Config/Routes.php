<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// test dll
$routes->get('/test', 'Test::index');
$routes->post('test/submit', 'Test::submit');

// login, register dll
$routes->get('/login', 'AuthController::login', ['namespace' => 'Myth\Auth\Controllers']);
$routes->get('/register', 'AuthController::register', ['namespace' => 'Myth\Auth\Controllers']);

// routes user
$routes->get('/dbuser', 'User::index');
$routes->get('/testResult', 'User::testResult');
$routes->get('/userTestDetail/(:num)', 'User::userTestDetail/$1');
$routes->get('/userProfile', 'UserProfile::index');
$routes->post('/updateProfile', 'UserProfile::updateProfile');
$routes->post('/deleteAccount', 'UserProfile::deleteAccount');
$routes->get('/downloadPdfUser/(:num)', 'User::downloadPdfUser/$1');

// routes admin
$routes->get('/dbadmin', 'Admin::index');
$routes->get('/userTestList', 'Admin::testList');
$routes->get('/detailTest/(:num)', 'Admin::detailTest/$1');
$routes->get('/pengetahuan', 'Pengetahuan::index');
$routes->get('/soalList', 'Pengetahuan::soalList');
$routes->post('/addSoal', 'Pengetahuan::addSoal');
$routes->post('/editSoal', 'Pengetahuan::editSoal');
$routes->delete('/deleteSoal/(:num)', 'Pengetahuan::deleteSoal/$1');
$routes->get('/users', 'Users::index');
$routes->get('/usersList', 'Users::usersList');
$routes->get('/usersDetail/(:num)', 'Users::usersDetail/$1');
$routes->get('/editUser/(:num)', 'Users::editUser/$1');
$routes->post('/updateUser/(:num)', 'Users::updateUser/$1');
$routes->delete('/deleteUser/(:num)', 'Users::deleteUser/$1');
$routes->get('/adminProfile', 'AdminProfile::index');
$routes->post('/updateAdProfile', 'AdminProfile::updateProfile');
$routes->post('/deleteAdAccount', 'AdminProfile::deleteAccount');
$routes->get('/downloadExcel', 'Admin::downloadExcel');
$routes->get('/downloadPdf/(:num)', 'Admin::downloadPdf/$1');
$routes->get('/deleteTest/(:num)', 'Admin::deleteTest/$1');
