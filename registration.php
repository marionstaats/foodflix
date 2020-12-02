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

    <!-- user form -->
    <form action="registration.php" method="post" id="user-form">
    <?php include('errors.php'); ?>
      
        <h1>Welcome to FoodFlix!</h1>
        <!-- Username -->
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        
        <!-- Gender for avatar in user-account -->
        <div id="gender">
          <input type="radio" id="male" name="gender" value="male" checked>
          <label for="male">Man</label>
          <input type="radio" id="female" name="gender" value="female">
          <label for="female">Woman</label><br>
        </div><br>
        
        <!-- Registration info -->
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="password_1">Password:</label>
        <input type="password" id="password_1" name="password_1" required><br>
        <label for="password_2">Confirm password:</label>
        <input type="password" id="password_2" name="password_2" required><br><br>

        <!-- Recipe preferences -->
        <fieldset >
          <legend>Language preference:</legend><br>
            <div id="preferences">
              <input type="radio" id="english" name="language" value="english" checked>
              <label for="english">English</label>
              <input type="radio" id="french" name="language" value="french">
              <label for="french">French</label><br>
            </div><br>

            <!-- <div id="preferences">
              <div>
                <input type="checkbox" id="drink" name="preference[]" value="drink">
                <label for="drink"> Beverages</label><br>
              </div>
              <div>
                <input type="checkbox" id="bake" name="preference[]" value="bake">
                <label for="bake"> Bake</label><br>
              </div>
              <div>
                <input type="checkbox" id="grill" name="preference[]" value="grill">
                <label for="grill"> Grill-bar</label><br>
              </div>
              <div>
                <input type="checkbox" id="soup" name="preference[]" value="soup">
                <label for="soup"> Soup</label><br>
              </div>
              <div>
                <input type="checkbox" id="salad" name="preference[]" value="salad">
                <label for="salad"> Salad and snacks</label><br>
              </div>
              <div>
                <input type="checkbox" id="main-course" name="preference" value="main-course">
                <label for="main-course"> Main courses</label><br><br>
              </div>
            </div> -->
        </fieldset><br>

        <input type="submit" value="Create my account" id="btn" name="reg_user">
      
    </form>

    <!-- showroom -->
    
    
</body>
</html>