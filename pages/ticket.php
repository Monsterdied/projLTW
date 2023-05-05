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
    <link href="../style_profile.css" rel="stylesheet">
    <link href="../ticketPage.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"ticket");
  drawSidebarADMIN($session);
  $ticket = Ticket::getTicketById($db, $_GET['TicketId']);
  $messages = Message::GetMessagesFromTicketId($db, $_GET['TicketId']);
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
      <h4><?=Ticket::getTimeDifference($ticket->published_Time)?></h3>
    </div>
  </div>
  <div class = "profileDepartments">
    <div class = "profileDepartmentsTitle">
    <div style="height:20em;width:20em;border:1px solid #ccc;font:16px/26px Georgia, Garamond, Serif;overflow:auto;">
      <?php foreach($messages as $message){ ?>
        <div class = "menssage">
          <div class
        </div>

        <?php } ?>
</div>
    
      <form action="profile_edit_Admin.php" method="GET">
        <input type="hidden" name="userid" value=<?=$user->id?>>          
        <button  type = "submit" name = "login">Change</button>
      </form>
  </div>    
<?php
  drawFooter($session);
  ?>