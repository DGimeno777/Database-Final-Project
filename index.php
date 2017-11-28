<?php
include "model/database.php";
include "model/user_db.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
}
else{
    $action = "homepage";
}

if($action == "profile"){
    $username = "";
    if($username = isset($_POST['username']) &&
        get_user_by_username($username)->rowCount() > 0) {

        $username = $_POST['username'];

        $user = get_user_by_username($username)->fetch();
            include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "login") {
    include "view/login.php";
}
else if($action == "login_go") {
    $check = false;
    $id = -1;
    if(isset($_POST['username']) &&
        isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (get_user_by_username($username)->rowCount() > 0) { // check to see if user exists
            $check = true;
            $user = get_user_by_username_and_password($username, $password)->fetch();
            $id = $user["UserID"];
        }
        else {
            echo "User does not exist exists";
        }
    }
    if ($check) {
        $user = get_user_by_userId($id)->fetch();
        include "view/profile.php";
    }
    else {
        include "view/login.php";
    }
}
else if($action == "register") {
    include "view/register.php";
}
else if($action == "register_go") {
    $check = false;
    $id = -1;
    if (isset($_POST['username']) &&
        isset($_POST['password']) &&
        isset($_POST['password_verify']) &&
        $_POST['password'] == $_POST['password_verify'] &&
        isset($_POST['user_type'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        $check = get_user_by_username($username);
        echo is_null($check);
        if ($check->rowCount() <= 0) {
            $check = true;
            register_user($username,$password,$user_type);
        }
        else {
            echo "User " . $username . " already exists";
        }
    }

    if ($check) {
        $user = get_user_by_userId($id);
        include "view/profile.php";
    }
    else {
        include "view/register.php";
    }
}
else{
    include "view/homepage.php";
}

?>
