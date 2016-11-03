<?php
$router = new AltoRouter();

//$router->setBasePath('/php_wf3/08-Composer');

// map homepage
$router->map( 'GET', '/', function() {
	require __DIR__ . '/../views/home.php';
}, 'home');

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