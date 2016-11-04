<?php
$router = new AltoRouter();

//$router->setBasePath('/php_wf3/08-Composer');

// map homepage
$router->map( 'GET', '/', function() {
	require __DIR__ . '/../views/home.php';
}, 'home');

$router->map( 'GET', '/post/list', function() {
	global $router, $db;
	require __DIR__ . '/../views/posts/list-post.php';
}, 'list-post');

$router->map( 'get|post', '/post/new', function() {
	global $router, $db;
	require __DIR__ . '/../views/posts/create-post.php';
}, 'new-post');

$router->map( 'POST', '/post/create', function() {
	global $router, $db;
	require __DIR__ . '/../views/posts/create-post.php';
}, 'create-post');

$router->map( 'GET', '/post/delete/[i:id]', function($id) {
	global $router, $db;
	require __DIR__ . '/../views/posts/delete-post.php';
}, 'delete-post');

$router->map( 'get', '/post/show/[i:id]', function($id)  {
	global $router, $db;
	require __DIR__ . '/../views/posts/create-post.php';
}, 'show-post');


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
