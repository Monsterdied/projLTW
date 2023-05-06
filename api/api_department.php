<?php


  //require_once(__DIR__ . '/../utils/session.php');
  //$session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');

    $db = getDatabaseConnection();
    $departements = Department::getAllDepartmentsFromUserId($db, $_GET['user_id']);

  echo json_encode($departements);
?>