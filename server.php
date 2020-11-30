<?php

session_start(); //checks when browser opens and 'remembers' session

//initializing variables

$username = "";
$email = "";

$errors = array();

//connect to db

$db = mysqli_connect('sql210.epizy.com','epiz_27350002','rbxI8DLfu7M','epiz_27350002_foodflix') or die("could not connect to database"); //server, user, pw, database name

//Registering users

if(isset($_POST['reg_user'])){

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
    $gender = mysqli_real_escape_string($db, $_POST['gender']);

    //form validation

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
        $password = password_hash($password_1, PASSWORD_DEFAULT); //encrypt password
        $query = "INSERT INTO user (username, email, password, gender) VALUES ('$username', '$email', '$password', '$gender')";
        
        mysqli_query($db,$query); //to run a query - first where? then what?
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";

        header('location: index.php');
    }
}

//Login user

if(isset($_POST['login_user'])){//if button has been clicked on login page

    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if(empty($username)){
        array_push($errors, "Username is required");
    }
    if(empty($password)){
        array_push($errors, "Password is required");
    }

    if(count($errors)==0){
        $query = "SELECT password FROM  user WHERE username='$username'";
        $query2 = "SELECT * FROM  user WHERE username='$username'";
        $results = mysqli_query($db, $query2);

        if((mysqli_num_rows($results)) && (password_verify($password,mysqli_fetch_assoc(mysqli_query($db,$query))['password']))){ //if password and username match start session
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "Logged in successfully";
            header('location: index.php');
        } else {
            array_push($errors, "Wrong username/password combination. Please try again.");
        }
    }
}
?>