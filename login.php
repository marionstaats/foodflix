<?php 
include('server.php');     
?>



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
    </div>

    <!-- main field -->
    <div id="login-background">
    </div>
    
    
    <!-- Login -->
    <div class="container" id="login-form">
         
        <form action="login.php" method="post" id="login">

            <?php include('errors.php'); ?>
            
            <div>
                <label for="username">Username: </label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="password">Password: </label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" name="login_user"> Login </button>

            <p>Not a user? <a href="registration.php">Register here</a></p>

        </form>
    </div>

</body>
</html>
