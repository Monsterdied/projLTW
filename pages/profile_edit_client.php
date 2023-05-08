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
    <link href="../css/style_profile.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"profile");
  drawSidebarADMIN($session);
  $user = User::getUser($db, $_GET["userid"]);
    $departments = Department::getAllDepartmentsFromUserId($db,(int) $_GET["userid"]);
    if( !($session->getType() == "ADMIN" || $session->getId() == $_GET["userid"])){
      header("Location: ./profile.php?userid=" . $_GET["userid"]);
    }
    $error = $_GET["error"];
?>
<div class = "profile">
          <form action = "/../actions/action_edit_user.php" method = "post" onSubmit="return validate();">
            <div class="item1">Username</div>
            <span id = "username_err"></span>
            <div class="item2"><input type="text" id="username" name="username" <?php echo "value=\""  . $user->username . "\""; ?>><br><br></div>
            <div class="item1">Name </div>
            <span id = "User_Name_err"></span>
            <div class="item2"><input type="text" id="User_Name" name="User_Name" <?php echo "value=\"" . $user->name . "\""; ?>><br><br></div>
            <div class="item1">Email address</div>
            <span id = "email_err"></span>
            <div class="item2"><input type="email" id="user_Email" name="user_Email" value = <?= $user->email?>><br><br></div>
            <div class="item1">Bio </div>
            <span id = "User_Name_err"></span>
            <div class="item2"><input type="text" id="User_Bio" name="User_Bio" <?php echo "value=\"" . $user->bio . "\""; ?>><br><br></div>
            <input type="hidden" name="User_id" value=<?=$user->id?>>
            <?php foreach ($session->getMessages() as $messsage) { ?>
              <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
              </article>
            <?php } ?>
            <h4><?=     $error ?></h4>
            <button type = "submit" name = "change">Change</button></div>  
        </form>
  </div>    
  <script>
    function validate() {
        var $valid = true;
        document.getElementById("username_err").innerHTML = "";
        document.getElementById("User_Name_err").innerHTML = "";
        document.getElementById("email_err").innerHTML = "";
        var username = document.getElementById("username").value;
        var user_Name = document.getElementById("User_Name").value;
        var user_Email = document.getElementById("user_Email").value;
        if(username == "") 
        {
            document.getElementById("username_err").innerHTML = "required  Username";
        	$valid = false;
        }
        if(user_Name == "") 
        {
            document.getElementById("User_Name_err").innerHTML = "required Name";
        	$valid = false;
        }
        if(user_Email == "") 
        {
        	document.getElementById("email_err").innerHTML = "required Email";
            $valid = false;
        }
        return $valid;
    }
    </script>
<?php
  drawFooter($session);
  
  ?>