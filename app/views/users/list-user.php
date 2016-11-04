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

    $query = $db->prepare('SELECT * FROM user');
    $query->execute();
	$result = $query->fetchAll(PDO::FETCH_ASSOC); 
?>
<table class="table table-hover">
    <caption>List des user</caption> 
    <thead> 
        <tr> 
            <th>Username</th> 
            <th>Email</th> 
            <th>Role</th> 
            <th>Actions</th> 
        </tr> 
    </thead> 
    <tbody>
        <?php foreach($result as $user): ?>
            <tr>
                <td><a href="<?php echo $router->generate('show-user', array('id' => $user['id'])); ?>"><?php echo ucfirst($user['username']); ?></a></td>
                <td>Email: <?php echo $user['email']; ?></td>
                <td>Role: <?php echo $user['role']; ?></td>
                <td><a href="<?php echo $router->generate('delete-user', array('id' => $user['id'])); ?>">Delete</a></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="<?php echo $router->generate('new-user'); ?>" class="btn btn-primary">Create User</a>
<a href="<?php echo $router->generate('home'); ?>" class="btn btn-default">Retourner à l'accueil</a>