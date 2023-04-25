<?php
  require_once(__DIR__ . '/util/session.php');
  $session = new Session();
  require_once(__DIR__ . '/database/connection.php');
  require_once(__DIR__ . '/database/departments.php');
  require_once(__DIR__ . '/database/user.php');

  require_once(__DIR__ . '/templates/common.php');
  require_once(__DIR__ . '/templates/commonAdmin.php');
  $db = getDatabaseConnection();
  //$departments = getAllDepartments($db);
  $users = User::getAllUsersWithLimit($db,8);
  $_SESSION['name'] = "Tomas Sarmento";

  drawHeader($session);
  drawSidebarADMIN($session);
  ?>

    <div class = "searchfield">        
            <input id="searchUser" type="text" placeholder="search">
            <select name="searchUserBy" id="searchUserBy">
              <option value="username">username</option>
              <option value="name">name</option>
            </select>
    </div>
    <script src="javascript/script.js"></script>
    <section id="Users">
      <?php 
        foreach($users as $user){  
        $departments = getAllDepartmentsFromUserId($db, $user->id);?>
          <section id="User">
            <div class="usernameClient"><?=$user->username?></div>
            <div class="nameClient"><?=$user->name?></div>
            <div class="typeClient"><?=$user->type?></div>
            <ul>
            <?php foreach($departments as $department){?>
              <li><?=$department->name?></li>

              <?php } ?>
            </ul>
          </section>
        <?php
          }
        ?>
    </section>
<?php
  drawFooter($session);
  ?>