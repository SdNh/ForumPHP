<?php
session_start();
require_once(__DIR__.'/../vendor/autoload.php');
require_once(__DIR__.'/../app/config/config.php');
require_once(__DIR__.'/../app/config/database.php');
require_once(__DIR__.'/../app/config/routes.php');

$match = $router->match();

require_once(__DIR__.'/../app/views/partials/header.php');
if( $match && is_callable( $match['target'] ) ) {
	call_user_func_array( $match['target'], $match['params'] ); 
} else {
	// no route was matched
	header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}
require_once(__DIR__.'/../app/views/partials/footer.php');
?>