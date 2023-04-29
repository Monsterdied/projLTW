<?php
    require_once (__DIR__ . "/../util/session.php");
    $session = new Session();
    $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $password = filter_var($_POST["User_password"], FILTER_SANITIZE_STRING);
    require_once (__DIR__ . "/../database/user.php");
    require_once (__DIR__ . "/../database/connection.php");
    $db = getDatabaseConnection();
    User::checkUser($db,$session,$username ,$password);
    if (! $session->isLoggedIn()) {
        $session->addMessage("error", "Invalid Credentials");
        header("Location: /../pages/login.php");
        exit();
    }else{
        header("Location: /../index.php");
        exit();
    

} 
?>
