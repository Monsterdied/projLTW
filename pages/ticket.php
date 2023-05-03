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
  $_SESSION['name'] = "Tomas Sarmento";
?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet">
    <link href="../ticket.css" rel="stylesheet">
  </head>

<body>
  <?php
  drawHeader($session,"profile");
  drawSidebarADMIN($session);
  ?> 
  <section id="Container">
    <h2>Messages:</h2>
    <div class="Message">
        <div class="Picture"><img src="https://picsum.photos/600/300?business" alt=""></div>
        <div class="nameSender">Mike</div>
        <div class="sendTime">17:00</div>
        <div class="Content">Hello World</div>
    </div>
    <div class="Message">
        <div class="Picture"><img src="https://picsum.photos/600/300?business" alt=""></div>
        <div class="nameSender">Mike</div>
        <div class="sendTime">17:00</div>
        <div class="Content">Hello World</div>
    </div>
  </div>
  <?php
  drawFooter($session);
  ?> 
</body>
