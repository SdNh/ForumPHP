<?php
$router = new AltoRouter();

//$router->setBasePath('http://forumphp.local');

// map homepage
$router->map( 'GET', '/', function() {
	require __DIR__ . '/../views/home.php';
}, 'home');

$router->map( 'GET', '/user/list', function() {
	global $router, $db;
	require __DIR__ . '/../views/users/list-user.php';
}, 'list-user');

$router->map( 'GET', '/user/new', function() {
	global $router, $db;
	require __DIR__ . '/../views/users/create-user.php';
}, 'new-user');

$router->map( 'GET', '/user/show/[i:id]', function($id) {
	global $router, $db;
	require __DIR__ . '/../views/users/create-user.php';
}, 'show-user');

$router->map( 'POST', '/user/create', function() {
	global $router, $db;
	require __DIR__ . '/../views/users/create-user.php';
}, 'create-user');

$router->map( 'GET', '/user/delete/[i:id]', function($id) {
	global $router, $db;
	require __DIR__ . '/../views/users/delete-user.php';
}, 'delete-user');

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