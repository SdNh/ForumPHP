<?php
    $email = (isset($_POST['email']) && !empty($_POST['email']))? strip_tags(trim($_POST['email'])):'';
    $password = (isset($_POST['password']) && !empty($_POST['password']))? strip_tags(trim($_POST['password'])):'';
    if($_SERVER['REQUEST_METHOD']=='POST' && !empty($email) && !empty($password)):
        $q = $db->prepare("SELECT * FROM user WHERE email=:email");
        $q->bindValue(':email', $email, PDO::PARAM_STR);
        
        $q->execute();
        $result = $q->fetch(PDO::FETCH_ASSOC);
        if(password_verify($password, $result['password'])):
            $_SESSION['id'] = $result['id'];
            $_SESSION['username'] = $result['username'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['enabled'] = $result['enabled'];
            header('Location: '.$router->generate('home'));
            exit;
        endif;
        
         
    endif;
?>

<?php if(!empty($_SESSION['id'])): ?>
        Bienvenue
        <ul>
            <li><a href="">Users</a></li>
            <li><a href="">Forums</a></li>
            <li><a href="">Posts</a></li>
            <li><a href="<?php echo $router->generate('logout'); ?>">Logout</a></li>
        </ul>
<?php else: ?>
<form method="POST" action="<?php echo $router->generate('home'); ?>">
  <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
  </div>
  <div class="checkbox">
    <label>
      <input type="checkbox"> Se souvenir de moi
    </label>
  </div>
  <button type="submit" class="btn btn-default">Se connecter</button>
  <a href="<?php echo $router->generate('register'); ?>"class="btn btn-success">S'inscrire</a>
</form>
<?php endif; ?>