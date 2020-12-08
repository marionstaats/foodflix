<?php

session_start(); //checks when browser opens and 'remembers' session

function str_random($length){
    $char = "0123456789azertyuiopmlkjhgfdsqwxcvbnAZERTYUIOPMLKJHGFDSQWXCVBN";
    return substr(str_shuffle(str_repeat($char,$length)),0,$length);
}

//initializing variables

$username = "";
$email = "";
$gender = "";
$preferences = [];

$errors = array();

//connect to db
// $db = mysqli_connect('sql210.epizy.com','epiz_27350002','rbxI8DLfu7M','epiz_27350002_foodflix') or die("could not connect to database"); //server, user, pw, database name
$db = mysqli_connect('localhost','root','root','foodflix') or die("could not connect to database"); //server, user, pw, database name

//Registering users

if(isset($_POST['reg_user'])){
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);
    $language = mysqli_real_escape_string($db, $_POST['language']);

    //form validation (also done in html so not needed?)

    if(empty($username)) {
        array_push($errors, "Username is required");
    };
    if(empty($email)) {
        array_push($errors, "Email is required");
    };
    if(empty($password_1)) {
        array_push($errors, "Password is required");
    };
    if($password_1 != $password_2){
        array_push($errors, "Passwords need to be the same");
    };

    // check db for existing usernames

    $user_check_query = "SELECT * FROM user WHERE username = '$username' or email = '$email' LIMIT 1";
    

    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if($user){
        if($user['username'] == $username){
            array_push($errors, "Username already exists");
        }
        if($user['email'] == $email){
            array_push($errors, "This email already has a registered username");
        }
    };

    //Register user if no error

    if (count($errors)== 0){
        $token = str_random(60);
        $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt password
        $query = "INSERT INTO user (username, email, password, gender, language, confirmation_token) VALUES ('$username', '$email', '$password', '$gender', '$language', '$token')";
        $query2 = "SELECT id FROM  user WHERE username='$username'";
        $id = mysqli_fetch_assoc(mysqli_query($db,$query2))['id'];
        
        mysqli_query($db,$query); //to run a query - first where? then what?
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        mail($email, "Welcome at Foodflix, please confirm your subscription.", "To confirm your subscription please click on the link just below : \n\n http://localhost/foodflix/login.php?id=$id&token=$token");
        header('location: login.php');
    }
}
// Confirmation email sent waiting for confirmation

if(isset($_GET['token']) && isset($_GET['id'])){        
    $id_confirmation = $_GET['id'];
    $query5 = "SELECT confirmed FROM user WHERE id='$id_confirmation'";
    $verify_already_confirmed = mysqli_fetch_assoc(mysqli_query($db,$query5))['confirmed'];
    $query3 = "SELECT confirmation_token FROM  user WHERE id='$id_confirmation'";
    $token_confirmed = mysqli_fetch_assoc(mysqli_query($db,$query3))['confirmation_token'];
    
    if ($verify_already_confirmed === '1') {
        array_push($errors, 'You\'ve already confirmed your email!');
    } elseif($token_confirmed === $_GET['token']) {
        $query4 = "UPDATE user SET confirmed = 1 WHERE id='$id_confirmation'";
        mysqli_query($db,$query4);
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "Logged in successfully";
        header('location: index.php'); 
    }
}  

//Login user

if(isset($_POST['login_user'])){//if button has been clicked on login page

    $username  = mysqli_real_escape_string($db, $_POST['username']);
    $password  = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($password)){
        array_push($errors, "Password is required");
    }

    if(count($errors)==0){
        $query = "SELECT password FROM  user WHERE username='$username'";
        $query2 = "SELECT confirmed FROM  user WHERE username='$username'";
        if ((int)mysqli_fetch_assoc(mysqli_query($db,$query2))['confirmed'] === 0){
            array_push($errors, "You need to confirm your email !");
        }elseif(password_verify($password,mysqli_fetch_assoc(mysqli_query($db,$query))['password'])){ //if password and username match start session
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in successfully";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination. Please try again.");
        }
    }
}
?>