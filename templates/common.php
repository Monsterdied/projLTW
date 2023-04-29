<?php 
      require_once(__DIR__ . '/../util/session.php');

?>
<?php function drawHeader(Session $session,string $title) { ?>

  <body>
    <header>
        <h2><a href="main.html"><?=$title?></a></h2>
        <?php if(!$session->isLoggedIn()){ ?>
        <element id="signup">
          <a href="register.php">Register</a>
          <a href="login.php">Login</a>
        </div><?php }else{ ?>
            <div class = "name_of_user">
            <?= $session->getName() ?>
            <a href="/../actions/action_logout.php">Logout</a>
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