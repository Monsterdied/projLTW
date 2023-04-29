<?php
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../database/user.php');

  require_once(__DIR__ . '/../templates/common.php');
  require_once(__DIR__ . '/../templates/commonAdmin.php');
  $db = getDatabaseConnection();
  //$departments = getAllDepartments($db);
?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet">
    <link href="../style_user.css" rel="stylesheet">
    <link href="../style_user_admin.css" rel="stylesheet">
    <link href="../style_profile.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"profile");
  drawSidebarADMIN($session);
  $user = User::getUser($db, $_GET['userid']);
    $departments = Department::getAllDepartmentsFromUserId($db,(int) $_GET['userid']);
?>
<div class = "profile">
  <div class = "profileInfo">
    <div class = "profileInfoName">
      <h1><?=$user->name?></h1>
    </div>

    <div class = "profileInfoUsername">
      <h2><?=$user->username?></h2>

    </div>
    <div class = "profileEmail">
      <h3><?=$user->email?></h2>
    </div>
    <div class = "profileInfoType">
      <h4><?=$user->type?></h3>
    </div>
  </div>
  <div class = "profileDepartments">
    <div class = "profileDepartmentsTitle">

    <?php if( $user->type == "CLIENT" && $user->type == "ADMIN"){ ?>

      <h1>Departments</h1>
    </div>
    <div class = "profileDepartmentsList">
      <?php
        foreach($departments as $department){  ?>
          <div class = "profileDepartmentsListDepartment">
            <h2><?=$department->name?></h2>
          </div>
        <?php
          }
        ?>
            
    </div>  <?php } ?>
    <?php if( $user->id == $session->getId()){ ?>
      <form action="nextpage.php" method="POST">
             
        <input type="submit"/>
      </form>
      <?php } ?>
  </div>    
<?php
  drawFooter($session);
  ?>