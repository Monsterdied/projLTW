<?php  
  require_once(__DIR__ . '/../util/session.php');
  $session = new Session();
?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>LTW</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../signUp.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2>Login into LTW</h2>
        </div>
    </header>
    <div class="main">
          <form action = "/../actions/action_login.php" method = "post" onSubmit="return validate();">
            <div class="item1">Username or email address</div>
            <span id = "username_err"></span>
            <div class="item2"><input type="text" id="username" name="username"><br><br></div>
            <div class="item3">Password</div>  
            <span id = "password_err"></span>
            <div class="item5"><input type="text" id="User_password" name="User_password"><br><br></div>
            <?php foreach ($session->getMessages() as $messsage) { ?>
              <article class="<?=$messsage['type']?>">
                <?=$messsage['text']?>
              </article>
            <?php } ?>
            <div class="item6"><button  type = "submit" name = "login">Sign in</button></div>    
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
        var username = document.getElementById("username").value;
        var password = document.getElementById("User_password").value;
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
        return $valid;
    }
    </script>
  </body>
</html>