<?php include('server.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>
    
    <div class="container">
        <div class="header">
            <h2>Register</h2>
        </div>

        <form action="registration.php" method="post">

            <?php include('errors.php'); ?>

            <div>
                <label for="username">Username : </label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="email">Email : </label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="password_1">Password : </label>
                <input type="password" name="password_1" required>
            </div>
            <div>
                <label for="password_2">Confirm password : </label>
                <input type="password" name="password_2" required>
            </div>
            <button type="submit" name="reg_user"> Submit </button>

            <p>Already a user?<a href="login.php">Login</a></p>

        </form>

    </div>

</body>
</html>