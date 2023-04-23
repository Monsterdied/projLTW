
<?php


  //require_once(__DIR__ . '/../utils/session.php');
  //$session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/user.php');

  $db = getDatabaseConnection();

  $users = User::searchUsersByUserName($db, $_GET['search'], 8);
  echo json_encode($users);
?>