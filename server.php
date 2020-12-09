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

$errors = array();

//connect to db
$db = mysqli_connect('sql210.epizy.com','epiz_27350002','rbxI8DLfu7M','epiz_27350002_foodflix') or die("could not connect to database"); //server, user, pw, database name
// $db = mysqli_connect('localhost','root','','foodflix') or die("could not connect to database"); //server, user, pw, database name

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
        mysqli_query($db,$query);
        $query2 = "SELECT id FROM user WHERE username='$username'";
        $id = mysqli_fetch_assoc(mysqli_query($db,$query2))['id'];
        
        $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now logged in";
        mail($email, "Welcome at Foodflix, please confirm your subscription.", "To confirm your subscription please click on the link just below : \n\n http://foodflix.rf.gd/login.php?id=$id&token=$token");
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

//Forgotten password
//Send email with link to change password
if(isset($_POST['mail_pw'])){
    $email = $_POST['username_pw'];
    $query7= "SELECT confirmation_token FROM user WHERE email='$email'";
    $token = mysqli_fetch_assoc(mysqli_query($db,$query7))['confirmation_token'];
    mail($email, "Welcome at Foodflix, please change your password.", "To change your password please click on the link just below : \n\n http://foodflix.rf.gd/passwordchange.php?email=$email&token=$token");
}


if(isset($_GET['email'])){
    $email = htmlentities($_GET['email']);
    $query6 = "SELECT confirmation_token FROM user WHERE email='$email'";
    $check_token = mysqli_query($db,$query6);
    $final_check = mysqli_fetch_assoc($check_token)['confirmation_token'];

    if ($final_check === htmlentities($_GET['token'])){
        $_SESSION['checkmail'] = $email;
    }
}

//Change password page after email forgotten pw
if(isset($_POST['forgot_pw'])){
    $email_confirmation = $_SESSION['checkmail'];
    $password_new_1 = password_hash(htmlentities($_POST['password_new_1']), PASSWORD_DEFAULT); //encrypt password
    $queryPW = "UPDATE user SET password = '$password_new_1' WHERE email = '$email_confirmation'";
    mysqli_query($db,$queryPW);
    var_dump($password_new_1);
    header('location: login.php');        
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
        var_dump(mysqli_fetch_assoc(mysqli_query($db,$query))['password']);
        var_dump(password_verify($password,mysqli_fetch_assoc(mysqli_query($db,$query))['password']));
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