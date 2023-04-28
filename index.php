<?php  
  require_once(__DIR__ . '/util/session.php');
  $session = new Session();
?>

<?php
  require_once('database/connection.php');
  require_once('database/ticket.php');
  require_once('database/departments.php');
  $_SESSION["User Status"] = "Admin";
  $db = getDatabaseConnection();
  $departments = Department::getAllDepartments($db);
  $tickets = Ticket::getTickets($db ,0,10);
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>LTW</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="ticket.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2><a href="index.php">All Tickets</a></h2>
        <element id="signup">
          <a href="register.html">Register</a>
          <a href="login.html">Login</a>
        </div>
    </header>
    <div class="sidenav">
        <h1>LTW</h1>
        <a href="#">My Tickets</a>
        <?php if($_SESSION["User Status"] == "Admin"){ ?>        
          <a href="pages/adminUserMonitoring.php">Admin</a>
          <?php
          }
        ?>

        <a href="#">Options</a>
        <a href="#">About</a>
    </div>
    <section id="Tickets">
          <?php foreach($tickets as $ticket){ ?>
        <div class="Ticket"> 

          <div class="clientPicture"><img src="https://picsum.photos/600/300?business" alt=""></div>
          <div class="nameTicket"><?= $ticket->content ?></div>
          <div class="statusNew"><?= $ticket->status->name ?></div>
          <div class="nameClient"><?= $ticket->client->name ?></div>
          <div class="departments"><?= $ticket->department->name ?></div>
        </div>
        <?php } ?>
      </section>
      <section id="Departments">
      <?php 
        foreach($departments as $department){
          ?> <a href="#"><?=$department->name?></a><?php
          }
        ?>
      </section>
      <footer>
        <p>&copy; LTW, 2023</p>
      </footer>
  </body>
</html>