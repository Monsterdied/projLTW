
<?php


  //require_once(__DIR__ . '/../utils/session.php');
  //$session = new Session();

  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/user.php');
  require_once(__DIR__ . '/../util/session.php');
  $db = getDatabaseConnection();
  if("ADMIN"!= Session::getType()){
      die(header('Location: /') ); }
  if($_GET['search_by'] == 'name'){
    $users = User::searchUsersByUserName($db, $_GET['search'], 8);
  }
  if($_GET['search_by'] == 'username'){
    $users = User::searchUsersByUser_username($db, $_GET['search'], 8);
  }
  echo json_encode($users);
?>