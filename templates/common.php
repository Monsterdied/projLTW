<?php 
      require_once(__DIR__ . '/../util/session.php');

?>
<?php function drawHeader(Session $session) { ?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="style.css" rel="stylesheet">
    <link href="style_user.css" rel="stylesheet">
    <link href="style_user_admin.css" rel="stylesheet">

  </head>
  <body>
    <header>
        <h2><a href="main.html">All Tickets</a></h2>
        <?php if($session->isLoggedIn()){ ?>
        <element id="signup">
          <a href="register.html">Register</a>
          <a href="login.html">Login</a>
        </div><?php }else{ ?>
            <div class = "name_of_user">
            <?= $session->getName() ?>
            </div>
            <?php }?>
        
    </header>
<?php } ?>


<?php function drawFooter(Session $session) { ?>
    <footer>
        <p>&copy; LTW, 2023</p>
      </footer>
  </body>
</html>
<?php } ?>