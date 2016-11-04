<?php    

    /*
    //CHECK SESSION EXIST AND TOKEN EXIST AND USER ROLE IS ADMIN ELSE REDIRECT 403 Forbidden
   
    if(empty($_SESSION['username']) && $_SESSION['role'] === 'admin'):
        //header("HTTP/1.1 403 Forbidden" );
        header("Location :". $router->generate('home'));
        exit;
    endif;
    */


    $username = (isset($_POST['username']) && !empty($_POST['username']))? strip_tags(trim($_POST['username'])):'';
    $email = (isset($_POST['email']) && !empty($_POST['email']))? strip_tags(trim($_POST['email'])):'';
    $password = (isset($_POST['password']) && !empty($_POST['password']))? strip_tags(trim($_POST['password'])):'';
    $oldpassword = (isset($_POST['oldpassword']) && !empty($_POST['oldpassword']))? strip_tags(trim($_POST['oldpassword'])):'';
    $role = (isset($_POST['role']) && !empty($_POST['role']))? strip_tags(trim($_POST['role'])):'';
    $enabled = (isset($_POST['enabled']) && !empty($_POST['enabled']))? strip_tags(trim($_POST['enabled'])):'';

    $action = (isset($_POST['action']) && !empty($_POST['action']))? strip_tags($_POST['action']):'';

    if(!empty($action) && $action == 'update'):
        $id = (isset($_POST['id']) && !empty($_POST['id']))? strip_tags(trim($_POST['id'])):'';
	    $update = $db->prepare('UPDATE user SET username = :username, email = :email, password = :password, role = :role, enabled = :enabled WHERE id = :id');

	    $update->bindValue(':id', $id, PDO::PARAM_INT);
	    $update->bindValue(':username', $username, PDO::PARAM_STR);
	    $update->bindValue(':email', $email, PDO::PARAM_STR);
        if(empty($password) && !empty($oldpassword)):
            $password = $oldpassword;
        else:
            $password = password_hash(trim($password), PASSWORD_DEFAULT);
        endif;  
	    $update->bindValue(':password', $password, PDO::PARAM_STR);
	    $update->bindValue(':role', $role, PDO::PARAM_STR);
        $enabled = ($enabled == 'on')? true : false;
	    $update->bindValue(':enabled', $enabled, PDO::PARAM_STR);

	    $update->execute();
        header('Location: '.$router->generate('list-user'));
        exit;
	endif;

	if(!empty($action) && $action == 'create'):

	    $create = $db->prepare('INSERT INTO user (`id`, `username`, `email`, `password`, `role`, `token`, `enabled`, `lastlogin`, `created_at`) VALUES (NULL, :username, :email, :password, :role, NULL, :enabled , NULL , NOW())');

	    $create->bindValue(':username', $username, PDO::PARAM_STR);
	    $create->bindValue(':email', $email, PDO::PARAM_STR);
	    $password = password_hash(trim($password), PASSWORD_DEFAULT);
	    $create->bindValue(':password', $password, PDO::PARAM_STR);
	    $create->bindValue(':role', $role, PDO::PARAM_STR);
        $enabled = ($enabled == 'on')? true : false;        
	    $create->bindValue(':enabled', $enabled, PDO::PARAM_BOOL);

	    $create->execute();

        header('Location: '.$router->generate('list-user'));
        exit;
	endif;

	if(!empty($id)):
	    $query = $db->prepare('SELECT * FROM user WHERE id = :id');

		$query->bindValue(':id', $id, PDO::PARAM_INT);
	    $query->execute();

	    $result = $query->fetchAll(PDO::FETCH_ASSOC);
	endif;

?>
<form method="POST" action="<?php echo $router->generate('create-user'); ?>" >
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="Nom Utilisateur" value="<?php echo (isset($result[0]['username']) && !empty($result[0]['username']))? $result[0]['username']:''; ?>">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Email Utilisateur" value="<?php echo (isset($result[0]['email']) && !empty($result[0]['email']))? $result[0]['email']:''; ?>">
    </div>

    <div class="form-group">
        <label for="password">Mot de passe</label>
        <input type="password" class="form-control" name="password" id="password" >
    </div>

    <select class="form-control" name="role">
        <option value="admin" <?php echo (isset($result[0]['role']) && !empty($result[0]['role']) && $result[0]['role'] === 'admin' )? 'selected':''; ?>>Admin</option>
        <option value="user" <?php echo (isset($result[0]['role']) && !empty($result[0]['role']) && $result[0]['role'] === 'user' )? 'selected':''; ?>>Utilisateur</option>
    </select>

    <div class="checkbox">
        <label>
            <input type="checkbox" name="enabled" <?php echo (isset($result[0]['enabled']) && !empty($result[0]['enabled']) && $result[0]['enabled'] == '1' )? 'checked':''; ?> > Activer l'utilisateur
        </label>
    </div>
    <input type="hidden" name="oldpassword" value="<?php echo (isset($result[0]['password']) && !empty($result[0]['password']))? $result[0]['password']:''; ?>">
    <input type="hidden" name="id" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? $result[0]['id']:''; ?>">
    <input type="hidden" name="action" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'update':'create'; ?>">

    <button type="submit" class="btn btn-primary">
        <?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'Mettre à jour':'Créer'; ?>    
    </button>
    <a href="<?php echo $router->generate('list-user'); ?>" class="btn btn-default">Retourner à la liste des utilisateurs</a>
</form>