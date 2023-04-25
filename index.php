<?php  
  require_once(__DIR__ . '/util/session.php');
  $session = new Session();
?>

<?php
  require_once('database/connection.php');
  require_once('database/departments.php');
  $_SESSION["User Status"] = "Admin";
  $db = getDatabaseConnection();
  $departments = getAllDepartments($db);
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>LTW</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2><a href="main.html">All Tickets</a></h2>
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
      <section id="Departments">
      <?php 
        foreach($departments as $department){
          ?> <a href="#"><?=$department['DEPARTEMENTS']?></a><?php
          }
        ?>
      </section>
      <footer>
        <p>&copy; LTW, 2023</p>
      </footer>
  </body>
</html>