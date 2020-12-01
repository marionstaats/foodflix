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
          <div id="user-register">
              <a href="index.php">
                  <i class="fas fa-home"></i>
                  <p>Home</p>
              </a>
          </div>
          <div id="user-login">
            <form action="index.php" method="post">
                    <button type="submit" name="logout"><a href="index.php"><i class="fas fa-sign-in-alt"></i><p>Log out</p></a></button>
                </form>   
          </div>
      </div>
    </div>
    
    <div id="user-info">
      <!-- user account -->
      <div id="user-account">
        <img src="../scss/chef-women.png" alt="" id="avatar">
        <div id="greetings">
          <h1>Hello, UserName!</h1>
          <div id="manage-profile">
            <p id="email">Email: username@hotmail.com</p>
            <p id="password">Password: ****</p>

            <a href="register.php">Manage your profile</a>
          </div>
        </div>
      </div>

      <!-- favorite videos -->
      <h1>My favorite video:</h1>
      <div>
        <br><br><br>
      </div>
    </div>

</body>
</html>
