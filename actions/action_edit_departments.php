<?php
    require_once (__DIR__ . "/../util/session.php");
    require_once (__DIR__ . "/../database/departments.php");
    require_once (__DIR__ . "/../database/connection.php");
    $session = new Session();
    if( ! $session->isLoggedIn()){  die(header('Location: /') ); }
    if($session->getType()!="ADMIN"){  die(header('Location: /') ); }
    $db = getDatabaseConnection();
    $departments = Department::getAllDepartments($db);
    foreach($departments as $department){
        $dep_name = filter_var($_POST[$department->id . "name"], FILTER_SANITIZE_STRING);
        $dep_sinopse = filter_var($_POST[$department->id . "sinopse"], FILTER_SANITIZE_STRING);
        Department::updateDepartment($db,$department->id,$dep_sinopse,$dep_name);
    }

        
        header("Location: /../pages/status_admin_edit.php");
        exit();

?>