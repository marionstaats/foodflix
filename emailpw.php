<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodflix</title>
    <link rel="icon" href="scss/pan.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="scss/main.css">
    <link href="https://fonts.googleapis.com/css2?family=Concert+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
</head>
<body>
    <!-- nav-bar -->
    <div id="nav-bar">
        <div id="logo">
          <h2>FoodFlix</h2>
          <i class="far fa-thumbs-up"></i>
        </div>
        
        <div id="user">
            <div id="user-login">
                <a href="login.php">
                    <i class="fas fa-user-circle"></i>
                    <p>Log in</p>
                </a>   
            </div>
        </div>
      </div>
    
    <!-- main field -->
    <div id="register-background">
        
    </div>

    <!-- password form -->
    <form action="emailpw.php" method="post" id="user-form">
      
        <h1>Receive an email to change your password</h1>
        <!-- User name -->
        <label for="username_pw">Email:</label>
        <input type="email" id="username_pw" name="username_pw" required><br>

        <input type="submit" value="Get email" id="btn" name="mail_pw">
    </form>    
    
</body>
</html>