<?php
$router = new AltoRouter();

//$router->setBasePath('/php_wf3/08-Composer');

// map homepage
$router->map( 'GET|POST', '/', function() {
	global $router, $db;
	require __DIR__ . '/../views/registration/login.php';
}, 'home');

$router->map( 'GET', '/logout', function() {
	global $router, $db;
	require __DIR__ . '/../views/registration/logout.php';
}, 'logout');

$router->map( 'GET|POST', '/register', function() {
	global $router, $db;
	require __DIR__ . '/../views/registration/register.php';
}, 'register');

/*
// map homepage
$router->map( 'GET', '/contact', function() {
	require __DIR__ . '/views/contact.php';
}, 'contact');

// map user details page
$router->map( 'GET', '/user/[i:id]/', function( $id ) {
	require __DIR__ . '/views/user-details.php';
}, 'user-details');

var_dump($match);

// call closure or throw 404 status
*/

// match current request url

?>