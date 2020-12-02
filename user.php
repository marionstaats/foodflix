<?php require('server.php');
  // check username using for logging
  $user = $_SESSION['username'];

  // get row from database
  if($user) {
    $query2 = "SELECT * FROM  user WHERE username='$user'";
    $results = mysqli_query($db, $query2);
    $userData = mysqli_fetch_assoc($results);
    
  };

  // create vars for users
  $userName = $userData['username'];
  $userEmail = $userData['email'];
  $userGender = $userData['gender'];
  $userId = $userData['id'];
  $userPrefs = $userData['preferences'];

  // Deleting account
	if(isset($_POST['delete'])){
		// Get form data
		$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);
    $query = "DELETE FROM user WHERE id =" .$delete_id;
    
    if(mysqli_query($db, $query)){
			header('Location: http://localhost/foodflix/php/login.php');
		} else {
			echo 'ERROR: '. mysqli_error($db);
		}

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
                    <button type="submit" name="logout" style="border:none; background:none"><a href="index.php"><i class="fas fa-sign-in-alt"></i><p>Log out</p></a></button>
                </form>   
          </div>
      </div>
    </div>
    
    <div id="user-info">
      <!-- user account -->
      <div id="user-account">
        <?php if ($userGender === 'female') :?>
        <img src="./scss/chef-women.png" alt="" id="avatar">
        <? else : ?> 
        <img src="./scss/chef-man.png" alt="" id="avatar">
        <?php endif;?>
        <div id="greetings">
          <h1>Hello, <?php echo $userName; ?>!</h1>
          <div id="manage-profile">
            <p id="email">Email: <?php echo $userEmail; ?></p>
            <p id="password">Password: ****</p>

            <a href="registration.php">Manage my profile</a>
            <div class="input-btn">
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <input type="hidden" name="delete_id" value="<?php echo $userData['id']; ?>">
              <input type="submit" name="delete" value="Delete my account" style="background-color: #874312; padding: 5px; border: 1px solid white; border-radius: 8px; font-size: 15px">
            </form>
            </div>
            
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
