<?php
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../database/user.php');
  require_once(__DIR__ . '/../database/ticket.php');

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
  $ticket = Ticket::getTicketById($db, $_GET['TicketId']);
  if(!$ticket){
    header("Location: /../index.php");
  }
    //$departments = Department::getAllDepartmentsFromUserId($db,(int) $_GET['userid']); load logs
?>
<div class = "Ticket">
  <div class = "TicketSummary">
    <div class = "TicketTitle">
      <h1><?=$ticket->content?></h1>
    </div>

    <div class = "TicketStatus">
      <h2><?=$ticket->status->name?></h2>

    </div>
    <div class = "ProblemPostedBy">
      <h3><?=$ticket->client->username?></h2>
    </div>
    <div class = "ProblemPostedTime">
      <h4><?=$ticket->published_Time?></h3>
    </div>
  </div>
  <div class = "profileDepartments">
    <div class = "profileDepartmentsTitle">
    <?php if($user->bio != "") {?>
  <div class = "Bio">
    <h5>Bio</h5>
    <h4><?=$user->bio ?></h4>
    </div>
    <?php } ?>
    <?php if( $user->type != "CLIENT"){ ?>
    
      <h6>Departments</h6>
    </div>
    <div class = "profileDepartmentsList">
      <?php
        foreach($departments as $department){  ?>
          <div class = "profileDepartmentsListDepartment">
            <h2><?=$department->name ?></h2>
          </div>
        <?php
          }
        ?>
            
    </div>  <?php } ?>
    <?php if($session->getType() == "ADMIN"){ ?>
      <form action="profile_edit_Admin.php" method="GET">
        <input type="hidden" name="userid" value=<?=$user->id?>>          
        <button  type = "submit" name = "login">Change</button>
      </form>
      <?php } ?>
    <?php if( $user->id == $session->getId() && $session->getType() != "ADMIN"){ ?>
      <form action="profile_edit_client.php" method="GET">
        <input type="hidden" name="userid" value=<?=$user->id?>>          
        <button  type = "submit" name = "login">Change</button>
      </form>
      <?php } ?>
  </div>    
<?php
  drawFooter($session);
  ?>