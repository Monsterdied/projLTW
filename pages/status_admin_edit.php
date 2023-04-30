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
    <link href="../style.css" rel="stylesheet">
    <link href="../style_user.css" rel="stylesheet">
    <link href="../style_user_admin.css" rel="stylesheet">
    <link href="../style_profile.css" rel="stylesheet">
  </head>
<?php



  drawHeader($session,"profile");
  drawSidebarADMIN($session);
    $departments = Department::getAllDepartments($db);
    if( !($session->getType() == "ADMIN" )){
      header("Location: ./profile.php?userid=" . $_GET["userid"]);
    }
    $error = $_GET["error"];
?>
<div class = "profile">
<form action = "/../actions/action_edit_departments.php" method = "post" onSubmit="return validate();">
    <h1> Edit Departments</h1>
        <?php foreach($departments as $department){?>
            <div class="deppartment"> Department </div>
            <span id = <?=  $department->id . "_err" ?>></span>
            <div class="item2"><input type="text" id=<?= $department->id . "name" ?> name=<?= $department->id . "name" ?> <?php echo "value=\""  . $department->name . "\""; ?>><br><br></div>
            <div class="deppartment"> Sinopse </div>
            <span id = <?=  $department->id . "_err_sinopse" ?>></span>
            <div class="item2"><input type="text" id=<?= $department->id . "sinopse"?> name=<?= $department->id . "sinopse"?> <?php echo "value=\""  . $department->sinopse . "\""; ?>><br><br></div>
            <br></br>
            <?php }?>
            <button type = "submit" name = "change">Change</button></div>  
        </form>
  </div>    

<?php
  drawFooter($session);
  
  ?>