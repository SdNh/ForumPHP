<?php
try {
	$db = new PDO('mysql:host=192.168.1.116;dbname=forumphp','forum','forum');

	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	/*$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);*/

}catch (PDOException $e) {
    print $e->getMessage();
}

    
?>