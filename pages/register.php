<?php    
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
  ?>
<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Register</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../css/signUp.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2>Register into LTW</h2>
        </div>
    </header>
    <div class="main">
        <form action = "/../actions/action_register.php" method = "post" onSubmit="return validate();">
            <div class="item1">Username</div>
            <span id = "username_err"></span>
            <div class="item2"><input type="text" id="username" name="username"><br><br></div>
            <div class="item1">Name </div>
            <span id = "User_Name_err"></span>
            <div class="item2"><input type="text" id="User_Name" name="User_Name"><br><br></div>
            <div class="item1">Email address</div>
            <span id = "email_err"></span>
            <div class="item2"><input type="email" id="user_Email" name="user_Email"><br><br></div>
            <div class="item3">Password</div>  
            <span id = "password_err"></span>
            <div class="item5"><input type="password" id="User_password" name="User_password"><br><br></div>
            
            <?php foreach ($session->getMessages() as $messsage) { ?>
              <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
              </article>
            <?php } ?>
            <button type = "submit" name = "sign_in_button">Sign up</button></div>  


        </form>
    </div>    
    <footer>
        <p>&copy; LTW, 2023</p>
    </footer>
  	<script>
    function validate() {
        var $valid = true;
        document.getElementById("username_err").innerHTML = "";
        document.getElementById("password_err").innerHTML = "";
        document.getElementById("User_Name_err").innerHTML = "";
        document.getElementById("email_err").innerHTML = "";
        var username = document.getElementById("username").value;
        var password = document.getElementById("User_password").value;
        var user_Name = document.getElementById("User_Name").value;
        var user_Email = document.getElementById("user_Email").value;
        if(username == "") 
        {
            document.getElementById("username_err").innerHTML = "required  Username";
        	$valid = false;
        }
        if(password == "") 
        {
        	document.getElementById("password_err").innerHTML = "required Password";
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
  </body>
</html>