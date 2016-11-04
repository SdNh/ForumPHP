<?php
if(!empty($id) && ctype_digit($id)):
		$delete = $db->prepare('DELETE FROM forum WHERE id = :id');
	    $delete->bindValue(':id', $id, PDO::PARAM_INT);
	    $delete->execute();    
    endif;
    header('Location: '.$router->generate('list-forum'));
    exit;
?>