<?php
$router = new AltoRouter();

//$router->setBasePath('/php_wf3/08-Composer');

// map homepage
$router->map( 'GET', '/', function() {
	require __DIR__ . '/../views/home.php';
}, 'home');


$router->map( 'GET', '/forum/list', function() {
	// j'injecte le router et ma variable de connexion à la base de donnée
	global $router, $db;
	require __DIR__ . '/../views/forums/list-forum.php';
}, 'list-forum');

$router->map( 'GET', '/forum/new', function() {
	global $router, $db;
	require __DIR__ . '/../views/forums/create-forum.php';
}, 'new-forum');

$router->map( 'GET', '/forum/show/[i:id]', function($id) {
	global $router, $db;
	require __DIR__ . '/../views/forums/create-forum.php';
}, 'show-forum');

$router->map( 'POST', '/forum/create', function() {
	global $router, $db;
	require __DIR__ . '/../views/forums/create-forum.php';
}, 'create-forum');

$router->map( 'GET', '/forum/delete/[i:id]', function($id) {
	global $router, $db;
	require __DIR__ . '/../views/forums/delete-forum.php';
}, 'delete-forum');
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