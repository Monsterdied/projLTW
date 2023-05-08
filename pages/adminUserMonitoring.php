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
  $users = User::getAllUsersWithLimit($db,8);
  if( !($session->getType() == "ADMIN" )){
    header("Location: ./profile.php?userid=" . $_GET["userid"]);
  }
?>
    <!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Admin</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/style_user.css" rel="stylesheet">
    <link href="../css/style_user_admin.css" rel="stylesheet">

  </head>
<?php
  drawHeader($session,"all users");
  drawSidebarADMIN($session);
  ?>

    <div class = "searchfield">        
            <input id="searchUser" type="text" placeholder="search">
            <select name="searchUserBy" id="searchUserBy">
              <option value="username">username</option>
              <option value="name">name</option>
            </select>
    </div>
    <script src="../javascript/script.js"></script>
    <section id="Users">
      <?php 
        foreach($users as $user){  ?>
          <a href=<?="profile.php?userid=" .  $user->id ?> >
            <section id="User">
              <div class="usernameClient"><?=$user->username?></div>
              <div class="nameClient"><?=$user->name?></div>
              <div class="typeClient"><?=$user->type?></div>
            </section>
          </a>
        <?php
          }
        ?>
    </section>
<?php
  drawFooter($session);
  ?>