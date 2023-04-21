<?php
  require_once('database/connection.php');
  require_once('database/user.php');

  $db = getDatabaseConnection();
  //$departments = getAllDepartments($db);
  $users = getAllUsers($db);
?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="style_user.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2><a href="main.html">All Tickets</a></h2>
        <element id="signup">
          <a href="register.html">Register</a>
          <a href="login.html">Login</a>
          <h2>        <input id="searchUser" type="text" placeholder="search"></h2>
        </div>

    </header>
    <div class="sidenav">
        <h1>Admin</h1>
        <a href="\">Home</a>
        <a href="#">Tickets</a>
        <a href="#">Users</a>
        <a href="#">Options</a>
        <a href="#">About</a>
    </div>
      <section id="Users">
      <?php 
        foreach($users as $user){ ?> 
          <section id="User">
          <div class="usernameClient"><?=$user['USERNAME']?></div>
          <div class="nameClient"><?=$user['NAME']?></div>
          <div class="typeClient"><?=$user['TYPE']?></div>
          </section>
        <?php
          }
        ?>
      </section>
      <footer>
        <p>&copy; LTW, 2023</p>
      </footer>
  </body>
</html>