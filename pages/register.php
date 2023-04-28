<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>Register</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../signUp.css" rel="stylesheet">
  </head>
  <body>
    <header>
        <h2>Register into LTW</h2>
        </div>
    </header>
    <div class="main">
        <form action = "/../actions/action_register.php" method = "post">
            <div class="item1">Username</div>
            <div class="item2"><input type="text" id="user" name="username"><br><br></div>
            <div class="item1">Name</div>
            <div class="item2"><input type="text" id="user" name="User_Name"><br><br></div>
            <div class="item1">Email address</div>
            <div class="item2"><input type="text" id="user" name="user_Email"><br><br></div>
            <div class="item3">Password</div>  
            <div class="item5"><input type="text" id="password" name="User_passwor"><br><br></div>
            <button type = "submit" onclick = "window.location.href='index.php'">Sign up</button></div>  
        </form>
    </div>    
    <footer>
        <p>&copy; LTW, 2023</p>
    </footer>
  	<script>
    function validate() {
        var $valid = true;
        document.getElementById("user_info").innerHTML = "";
        document.getElementById("password_info").innerHTML = "";
        
        var userName = document.getElementById("user_name").value;
        var password = document.getElementById("password").value;
        if(userName == "") 
        {
            document.getElementById("user_info").innerHTML = "required";
        	$valid = false;
        }
        if(password == "") 
        {
        	document.getElementById("password_info").innerHTML = "required";
            $valid = false;
        }
        return $valid;
    }
    </script>
  </body>
</html>