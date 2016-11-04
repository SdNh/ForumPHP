<?php

    $username = (isset($_POST['username']) && !empty($_POST['username']))? strip_tags(trim($_POST['username'])):'';
    $email = (isset($_POST['email']) && !empty($_POST['email']))? strip_tags(trim($_POST['email'])):'';
    $password = (isset($_POST['email']) && !empty($_POST['email']))? strip_tags(trim($_POST['password'])):'';
    $action = (isset($_POST['action']) && !empty($_POST['action']))? strip_tags($_POST['action']):'';
    if(!empty($action) && $action == 'create'):
	    $create = $db->prepare('INSERT INTO user (`id`, `username`, `email`, `password`, `role`, `token`, `enabled`, `lastlogin`, `created_at`) VALUES (NULL, :username, :email, :password, :role, NULL, :enabled , NULL , NOW())');
	    $create->bindValue(':username', $username, PDO::PARAM_STR);
	    $create->bindValue(':email', $email, PDO::PARAM_STR);
	    $password = password_hash(trim($password), PASSWORD_DEFAULT);
	    $create->bindValue(':password', $password, PDO::PARAM_STR);
	    $create->bindValue(':role', 'user', PDO::PARAM_STR);
        $create->bindValue(':enabled', true, PDO::PARAM_BOOL);
	    $create->execute();

        header('Location: '.$router->generate('home'));
        exit;
	endif;
?>

<form method="POST" action="<?php echo $router->generate('register'); ?>" >
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
    <input type="hidden" name="action" value="<?php echo (isset($result[0]['id']) && !empty($result[0]['id']))? 'update':'create'; ?>">

    <button type="submit" class="btn btn-primary">
        Je m'inscris
    </button>
    <a href="<?php echo $router->generate('home'); ?>" class="btn btn-default">Retourner à l'accueil</a>
</form>