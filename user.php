<?php require('server.php');
  // check username using for logging
  $user = $_SESSION['username'];

  // get row from database
  if($user) {
    // get data from table User
    $query2 = "SELECT * FROM  user WHERE username='$user'";
    $results = mysqli_query($db, $query2);
    $userData = mysqli_fetch_assoc($results);
  };

  // create vars for users
  $userName = $userData['username'];
  $userEmail = $userData['email'];
  $userGender = $userData['gender'];
  $userId = $userData['id'];
  $userLang = $userData['language'];

  // Update account
  if(isset($_POST['update'])){
    // Get form data
    $_varForUpdate = [];

    if(!empty($_POST['usernameUpdate'])) {
      $usernameUpdate = mysqli_real_escape_string($db, $_POST['usernameUpdate']);
      $usernameCell = " username = '$usernameUpdate' ";
      $_varForUpdate[] = $usernameCell;
    };

    if(!empty($_POST['emailUpdate'])) {
      $emailUpdate = mysqli_real_escape_string($db, $_POST['emailUpdate']);
      $emailCell = " email = '$emailUpdate' ";
      $_varForUpdate[] = $emailCell;
    };

    if(!empty($_POST['genderUpdate'])) {
      $genderUpdate = mysqli_real_escape_string($db, $_POST['genderUpdate']);
      $genderCell = " gender = '$genderUpdate' ";
      $_varForUpdate[] = $genderCell;
    };
    
    if(!empty($_POST['languageUpdate'])) {
      $languageUpdate = mysqli_real_escape_string($db, $_POST['languageUpdate']);
      $languageCell = " language = '$languageUpdate' ";
      $_varForUpdate[] = $languageCell;
    };
    
    $strToQuery = implode (", ", $_varForUpdate);

    $queryUpdate = "UPDATE user SET" . $strToQuery . "WHERE id = '$userId'";
		
    if(mysqli_query($db, $queryUpdate)){
			header('Location: http://localhost/foodflix/login.php');
		} else {
			echo 'ERROR: '. mysqli_error($db);
		}

  }


  // Delete account
	if(isset($_POST['delete'])){
		// Get form data
		$delete_id = mysqli_real_escape_string($db, $_POST['delete_id']);
    $query = "DELETE FROM user WHERE id =" .$delete_id;
    
    if(mysqli_query($db, $query)){
			header('Location: http://localhost/foodflix/login.php');
		} else {
			echo 'ERROR: '. mysqli_error($db);
		}

  }
  
  // Get video which user saved in account

  if(isset($_POST['save-video'])){
    // Get data from save-btn
    $video_link = mysqli_real_escape_string($db, $_POST['data']);
    $query = "INSERT INTO videos (link, date, idUser) VALUES ('$video_link', now(), '$userId')";

    if(mysqli_query($db, $query)){
			header('Location: http://localhost/foodflix/user.php');
		} else {
			echo 'ERROR: '. mysqli_error($db);
		}
  }
  
  if($userId) {
    // get data from videos table
    $queryUserVideo = "SELECT * FROM videos WHERE idUser='$userId' GROUP BY link ORDER BY date DESC";
    $resultUserVideo = mysqli_query($db, $queryUserVideo);
  }

  // Delete video
	if(isset($_POST['delete_video'])){
		// Get form data
		$video_id = mysqli_real_escape_string($db, $_POST['video_id']);
    $queryDeleteVideo = "DELETE FROM videos WHERE idVideo =" .$video_id;
    
    if(mysqli_query($db, $queryDeleteVideo)){
			header('Location: http://localhost/foodflix/user.php');
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
        <!-- avatar: man or woman -->
        <?php if ($userGender === 'female') :?>
        <img src="./scss/chef-women.png" alt="" id="avatar" height="280px">
        <?php else : ?> 
        <img src="./scss/chef-man.png" alt="" id="avatar" height="280px">
        <?php endif;?>
        <div id="greetings">
          <div id="name-flag">
          <!-- add name of user -->
          <h1>Hello, <?php echo $userName; ?>! </h1>
          <!-- add language of user -->
          <?php if ($userLang === 'french') :?>
            <img src="https://lipis.github.io/flag-icon-css/flags/4x3/fr.svg" alt="">
            <?php else : ?> 
            <img src="https://lipis.github.io/flag-icon-css/flags/4x3/gb.svg" alt="">
          <?php endif;?>
          </div>
          <div id="manage-profile">
            <!-- add email of user -->
            <p id="email">Email: <?php echo $userEmail; ?></p>
            <p id="password">Password: ****</p>

            <button id="update-btn" style="background-color: #9d4e15; color: white; padding: 5px; align-self: center; border: 1px solid white; border-radius: 8px; box-shadow: 1px 1px 3px #706f6f; font-size: 25px;">Manage my profile</button>
            <!-- update user-info in database -->
            <form class="hide" id="update-form" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="text-align: center;">
                <fieldset style="padding: 5px; margin-top: 10px; margin-bottom: 10px;">
                  <a href="###" id="close_window" style="display: flex; justify-content: flex-end"><i class="far fa-window-close" style="color: #9d4e15"></i></a><br>
                  
                  <label for="usernameUpdate">Change my name:</label>
                  <input type="text" name="usernameUpdate"> <br>

                  <label for="emailUpdate">Change my email:</label>
                  <input type="email" name="emailUpdate"> <br>

                  <input type="radio" name="languageUpdate" value="english" checked>
                  <label for="english">English</label>
                  <input type="radio" name="languageUpdate" value="french">
                  <label for="french">French</label><br>

                  <input type="radio" name="genderUpdate" value="male" checked>
                  <label for="male">Man</label>
                  <input type="radio" name="genderUpdate" value="female">
                  <label for="female">Woman</label><br>

                  <input type="submit" name="update" value="Update my profile" style="color: white; background-color: #874312; padding: 5px; border: 1px solid white; border-radius: 8px; font-size: 15px">
                  <br>
                </fieldset>
            </form>
            <!-- delete btn -->
            <div class="input-btn">
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="delete_id" value="<?php echo $userData['id']; ?>">
                <input type="submit" name="delete" value="Delete my account" style="color: white; background-color: #874312; padding: 5px; border: 1px solid white; border-radius: 8px; font-size: 15px">
              </form>
            </div>
            
          </div>
        </div>
      </div>

      <!-- favorite videos -->
      <h1>My favorite video:</h1>
      <br>
      <?php
        while ($row = mysqli_fetch_assoc($resultUserVideo)) {
          printf ("%s \n", $row["date"]);
          ?>
          <div>
            <iframe class="youtube" src="<?php echo($row["link"])?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
            <br>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="video_id" value="<?php echo $row['idVideo']; ?>">
                <input type="submit" name="delete_video" value="Delete video" style="color: white; background-color: #874312; padding: 5px; border: 1px solid white; border-radius: 8px; font-size: 15px">
            </form>
            <br><br>
          </div>
          <?php
      }
      ?>  
    </div>
    <script src="javascript/user_update.js"></script>
</body>
</html>
