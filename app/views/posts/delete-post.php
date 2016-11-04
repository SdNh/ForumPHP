<?php
    /*
    //CHECK SESSION EXIST AND TOKEN EXIST AND USER ROLE IS ADMIN ELSE REDIRECT 403 Forbidden
    $token = (isset($_REQUEST['token']) && !empty($_REQUEST['token']))? trim($_REQUEST['token']):'';
    if(empty($_SESSION['username']) && empty($_SESSION['token']) && $_SESSION['token'] != $token && $_SESSION['role'] === 'admin'):
        //header("HTTP/1.1 403 Forbidden" );
        header("Location :". $router->generate('home'));
        exit;
    endif;
    */
	if(!empty($id) && ctype_digit($id)):
		  $delete = $db->prepare('DELETE FROM post WHERE id = :id');
	    $delete->bindValue(':id', $id, PDO::PARAM_INT);
	    $delete->execute();
    endif;
    header('Location: '.$router->generate('list-post'));
    exit;
?>
