<?php  
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
?>

<?php
  require_once(__DIR__ . '/../database/connection.php');
  require_once(__DIR__ . '/../database/ticket.php');
  require_once(__DIR__ . '/../database/departments.php');
  require_once(__DIR__ . '/../templates/common.php');
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
    <link href="/../css/style.css" rel="stylesheet">
    <link href="/../css/ticket.css" rel="stylesheet">
  </head>
  <body>
  <body>
    <header>
        <h2><a href="main.html"><?=$title?></a></h2>
        <?php if(!$session->isLoggedIn()){ ?>
        <element id="signup">
          <a href="pages/register.php">Register</a>
          <a href="pages/login.php">Login</a>
        </div><?php }else{ ?>
            <div class = "name_of_user">
            <a href=<?="pages/profile.php?userid=" . $session->getId() ?> >
            <?= $session->getName() ?></a>
            <a href="/../actions/action_logout.php">Logout</a>
            </div>
            <?php }?>
        
    </header>
    <div class="sidenav">
        <h1>LTW</h1>
        <a href="#">My Tickets</a>
        <?php if($session->getType() == "ADMIN"){ ?>        
          <a href="pages/adminUserMonitoring.php">Admin</a>
          <?php
          }
        ?>

        <a href="#">Options</a>
        <a href="#">About</a>
    </div>
    <section id="Tickets">
          <?php foreach($tickets as $ticket){ ?>
            <a href=<?="pages/ticket_page.php?TicketId=" .  $ticket->id ?>>
              <div class="Ticket"> 

                <div class="clientPicture"><img src="https://picsum.photos/600/300?business" alt=""></div>
                <div class="nameTicket"><?= $ticket->content ?></div>
                <div class="statusNew"><?= $ticket->status->name ?></div>
                <div class="nameClient"><?= $ticket->client->name ?></div>
                <div class="departments"><?= $ticket->department->name ?></div>
              </div>
            </a>
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