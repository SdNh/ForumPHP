<?php
    if($_SESSION['id']):
    unset($_SESSION['id']);
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['role']);
    unset($_SESSION['enabled']);
    session_destroy();
    endif;
    header('Location: '.$router->generate('home'));
    exit;
?>