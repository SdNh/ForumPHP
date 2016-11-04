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
    $title = (isset($_POST['title']) && !empty($_POST['title']))? strip_tags(trim($_POST['title'])):'';
    $content = (isset($_POST['content']) && !empty($_POST['content']))? strip_tags(trim($_POST['content'])):'';
    $answer = (isset($_POST['answer']) && !empty($_POST['answer']))? strip_tags(trim($_POST['answer'])):'';

    $forum_id = (isset($_POST['forum_id']) && !empty($_POST['forum_id']))? strip_tags(trim($_POST['forum_id'])):6;
    $author_id = (isset($_POST['author_id']) && !empty($_POST['author_id']))? strip_tags(trim($_POST['author_id'])):2;


    $action = (isset($_POST['action']) && !empty($_POST['action']))? strip_tags($_POST['action']):'';

    if(!empty($action) && $action == 'update'):
        $id = (isset($_POST['id']) && !empty($_POST['id']))? strip_tags(trim($_POST['id'])):'';
	    $update = $db->prepare('UPDATE post SET title = :title, content = :content, answer = :answer, author_id = :author_id, forum_id = :forum_id WHERE id = :id');
	    $update->bindValue(':id', $id, PDO::PARAM_INT);
	    $update->bindValue(':title', $title, PDO::PARAM_STR);
      $update->bindValue(':content', $content, PDO::PARAM_STR);
      $answer = (isset($_POST['answer']) && !empty($_POST['answer']))? strip_tags(trim($_POST['answer'])):$id;
	    $update->bindValue(':answer', $answer, PDO::PARAM_INT);
      $update->bindValue(':author_id', $author_id, PDO::PARAM_INT);
      $update->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);

	    $update->execute();
      
        header('Location: '.$router->generate('list-post'));
        exit;
	endif;
	if(!empty($action) && $action == 'create'):
	    $create = $db->prepare('INSERT INTO post (`title`, `content`, `date`, `author_id`,`forum_id`) VALUES (:title, :content, NOW(), :author_id, :forum_id)');
	    $create->bindValue(':title', $title, PDO::PARAM_STR);
	    $create->bindValue(':content', $content, PDO::PARAM_STR);

      $create->bindValue(':author_id', $author_id, PDO::PARAM_INT);
      $create->bindValue(':forum_id', $forum_id, PDO::PARAM_INT);

	    $create->execute();
        header('Location: '.$router->generate('list-post'));
        exit;
	endif;
	if(!empty($id)):
	    $query = $db->prepare('SELECT * FROM post WHERE id = :id');
		$query->bindValue(':id', $id, PDO::PARAM_INT);
	    $query->execute();
	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	endif;
?>
<form method="POST" action="<?php echo $router->generate('new-post'); ?>" >
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" name="title" id="title" value="<?php echo (isset($result[0]['title']) && !empty($result[0]['title']))? $result[0]['title']:''; ?>">
    </div>

    <div class="form-group">
        <label for="message">Message</label>
        <textarea placeholder="Entrez votre message" name="content" value="<?php echo (isset($result[0]['content']) && !empty($result[0]['content']))? $result[0]['content']:''; ?>"></textarea>
    </div>

    <input type="hidden" name="oldtitle" value="<?php echo (isset($result[0]['title']) && !empty($result[0]['title']))? $result[0]['title']:''; ?>">
    <input type="hidden" name="id" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? $result[0]['id']:''; ?>">
    <input type="hidden" name="action" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'update':'create'; ?>">

    <button type="submit" class="btn btn-primary">
        <?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'Mettre à jour':'Créer'; ?>
    </button>
    <a href="<?php echo $router->generate('list-post'); ?>" class="btn btn-default">Retourner à la liste des postes</a>
</form>
