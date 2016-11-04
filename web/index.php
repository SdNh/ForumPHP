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
<!--html>
  <head>
    <title>Ajouter forum</title>
  </head>
<body>
<form name="ajouter" action="ajouter2.php" method="POST">
  <table border="0" align="center" cellspacing="2" cellpadding="2">
    <tr align="center">
      <td>title</td>
      <td><input type="text" name="title"></td>
    </tr>
    <tr align="center">
      <td>description</td>
      <td><input type="text" name="description"></td>
    </tr>
    <tr align="center">
      <td>image</td>
      <td><input type="text" name="image"></td>
    </tr>
    
 
    <tr align="center">
      <td colspan="2"><input type="submit" value="insérer"></td>
    </tr>
  </table>
</form>
</body>
</html-->