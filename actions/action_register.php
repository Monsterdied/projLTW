<?php
    require_once (__DIR__ . "/../util/session.php");
    $session = new Session();
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $password = filter_var($_POST["User_password"], FILTER_SANITIZE_STRING);
        $email_real = filter_var($_POST["user_Email"], FILTER_SANITIZE_STRING);
        $User_Name = filter_var($_POST["User_Name"], FILTER_SANITIZE_STRING);
        require_once (__DIR__ . "/../database/user.php");
        require_once (__DIR__ . "/../database/connection.php");
        $db = getDatabaseConnection();
        
        $user = User::checkIfUserExists($db,$username);
        $email = User::checkIfEmailExists($db,$email_real);

        if ($user) {
            $session->addMessage("error", "username already exists");
            header("Location: /../pages/register.php");
            exit();
        }
        if ($email) {
            $session->addMessage("error", "email already exists");
            header("Location: /../pages/register.php");
            exit();
        }
        User::addUser($db,$username,$User_Name,$email_real,$password);
        $User_session = User::getUserByUsername($db,$username);
        $session->setId($User_session->id);
        $session->setName($User_Name);
        $session->setType("CLIENT");
        header("Location: /../index.php");
        exit();

?>