<?php

session_start();

if(!isset($_SESSION['username'])){ //not logged in yet
    $_SESSION['msg'] = "You must login first to view this page";
    header("location: login.php");
}

if(isset($_POST['logout'])){ //logging out
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
}
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
        <i class="far fa-thumbs-up"></i>
        <div id="user">
            <div id="user-register">
                <form action="index.php" method="post">
                    <button id="logout" type="submit" name="logout" style="border:none; background:none"><a href="index.php"><i class="fas fa-sign-in-alt"></i><p>Log out</p></a></button>
                </form> 

            </div>
            <div id="user-login">
                <a href="user.php">
                    <i class="fas fa-user-circle"></i>
                    <p>User</p>
                </a>
                
            </div>
        </div>
    </div>
    <!-- If user logs in print info about him -->

    <?php
        if(isset($_SESSION['username'])) : ?>
        <h3>Welcome <?php echo $_SESSION['username']; ?></h3>
    <?php endif ?>

    <!-- searcing field -->
    <div id="search-bar">
        <h1>FoodFlix</h1>
        <p>Find your best recipe</p>
        <input type="text" id="research">
        <input type="submit" id="submit" value="Find my recipe">
    </div>

    <!-- showroom -->

    <!-- php -->
    <?php
    if(isset($_SESSION['success'])) : //shows below only if successful login?> 

    <div>
        <h3>
        <?php
        unset($_SESSION['success']);
        ?>
        </h3>
    </div>
    <?php endif //to finish if statement above ?>

    <!--javascript  -->
    <script src="javascript/index.js"></script>
</body>
</html>
