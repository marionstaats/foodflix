<?php

session_start();

if(!isset($_SESSION['username'])){ //not logged in yet
    $_SESSION['msg'] = "You must login first to view this page";
    header("location : login.php");
}

if(isset($_POST['logout'])){ //logging out
    session_destroy();
    unset($_SESSION['username']);
    header("location : login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    
    <h1>This is the homepage</h1>

    <?php
    if(isset($_SESSION['success'])) : //shows below only if successful login?> 

    <div>
        <h3>
        <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
        </h3>
    </div>

    <?php endif //to finish if statement above ?>

    <!-- If user logs in print info about him -->

    <?php
    if(isset($_SESSION['username'])) : ?>
    <h3>Welcome <?php echo $_SESSION['username']; ?></h3>

    <form action="index.php" method="post">
        <button type="submit" name="logout"><a href="index.php"></a>Logout</button>
    </form>

    <?php endif ?>

</body>
</html>