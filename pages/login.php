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
        <div class="login">
            <div class="item1">Username or email address</div>
            <div class="item2"><input type="text" id="user" name="user"><br><br></div>
            <div class="item3">Password</div>  
            <div class="item4"><a href="forgot_pass.html">Forgot password?</a></div>
            <div class="item5"><input type="text" id="password" name="password"><br><br></div>
            <div class="item6"><button>Sign in</button></div>    
        </div>
    </div>    
    <footer>
        <p>&copy; LTW, 2023</p>
    </footer>
  </body>
</html>