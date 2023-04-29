<?php
    require_once (__DIR__ . "/../util/session.php");
    $session = new Session();
    if( ! $session->isLoggedIn()){  die(header('Location: /') ); }
    if($session->getType()!="ADMIN"){  die(header('Location: /') ); }
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $userID = filter_var($_POST["User_id"], FILTER_SANITIZE_STRING);
        $email_real = filter_var($_POST["user_Email"], FILTER_SANITIZE_STRING);
        $User_Name = filter_var($_POST["User_Name"], FILTER_SANITIZE_STRING);
        $User_bio = filter_var($_POST["User_Bio"], FILTER_SANITIZE_STRING);
        $User_Type = filter_var($_POST["User_Status"], FILTER_SANITIZE_STRING);
        require_once (__DIR__ . "/../database/user.php");
        require_once (__DIR__ . "/../database/connection.php");
        $db = getDatabaseConnection();
        $old_user = User::getUser($db,$userID);
        $user = User::checkIfUserExists($db,$username);
        $email = User::checkIfEmailExists($db,$email_real);

        if ($user && $old_user->username != $username) {
            $session->addMessage("error", "username already exists");
            header("Location: /../pages/profile_edit_Admin.php?userid=$userID&error=username_already_exists");
            exit();
        }
        if ($email && $old_user->email != $email_real) {
            $session->addMessage("error", "email already exists");
            header("Location: /../pages/profile_edit_Admin.php?userid=$userID&error=email_already_exists");
            exit();
        }
        $user_new = new User($userID,$User_Name,$username,$email_real,(string)$User_bio ,$User_Type,$old_user->profilepick);
        $user_new->save($db);
        header("Location: /../pages/profile.php?userid=$userID");
        exit();

?>