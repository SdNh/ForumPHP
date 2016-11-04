<?php
 	$title = (isset($_POST['title']) && !empty($_POST['title']))? strip_tags(trim($_POST['title'])):'';
    $description = (isset($_POST['description']) && !empty($_POST['description']))? strip_tags(trim($_POST['description'])):'';
    $image = (isset($_POST['image']) && !empty($_POST['image']))? strip_tags(trim($_POST['image'])):'';
    
    $action = (isset($_POST['action']) && !empty($_POST['action']))? strip_tags($_POST['action']):'';

    if(!empty($action) && $action == 'update'):
        $id = (isset($_POST['id']) && !empty($_POST['id']))? strip_tags(trim($_POST['id'])):'';
	    $update = $db->prepare('UPDATE forum SET title = :title, description = :description, image = :image WHERE id = :id');
	    $update->bindValue(':id', $id, PDO::PARAM_STR);
	    $update->bindValue(':title', $title, PDO::PARAM_STR);
	    $update->bindValue(':description', $description, PDO::PARAM_STR);
	    $update->bindValue(':image', $image, PDO::PARAM_STR);

	    $update->execute();
        header('Location: '.$router->generate('list-forum'));
        exit;
	endif;
	if(!empty($action) && $action == 'create'):
	    $create = $db->prepare('INSERT INTO forum (`title`, `description`, `image`) VALUES (:title, :description, :image)');
	    $create->bindValue(':title', $title, PDO::PARAM_STR);
	    $create->bindValue(':description', $description, PDO::PARAM_STR);
	    $create->bindValue(':image', $image, PDO::PARAM_STR);
	    $create->execute();
        header('Location: '.$router->generate('list-forum'));
        exit;
	endif;
	if(!empty($id)):
	    $query = $db->prepare('SELECT * FROM forum WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
	    $query->execute();
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	endif;
?>
<form method="POST" action="<?php echo $router->generate('create-forum'); ?>" >
    <div class="form-group">
        <label for="title">title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Titre" value="<?php echo (isset($result[0]['title']) && !empty($result[0]['title']))? $result[0]['title']:''; ?>">
    </div>

    <div class="form-group">
        <label for="description">description</label>
        <input type="text" class="form-control" name="description" id="description" placeholder="description" value="<?php echo (isset($result[0]['description']) && !empty($result[0]['description']))? $result[0]['description']:''; ?>">
    </div>

    <div class="form-group">
        <label for="image">image</label>
        <input type="text" class="form-control" name="image" id="image" >
    </div>

    
    <input type="hidden" name="oldtitle" value="<?php echo (isset($result[0]['title']) && !empty($result[0]['title']))? $result[0]['title']:''; ?>">
    <input type="hidden" name="id" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? $result[0]['id']:''; ?>">
    <input type="hidden" name="action" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'update':'create'; ?>">

    <button type="submit" class="btn btn-primary">
        <?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'Mettre à jour':'Créer'; ?>    
    </button>
    <a href="<?php echo $router->generate('list-forum'); ?>" class="btn btn-default">Retourner à la liste des forums</a>
</form>