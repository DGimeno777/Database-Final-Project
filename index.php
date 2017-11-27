<?php
include "model/database.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
}
else{
    $action = "homepage";
}

if($action == "profile"){
    if(isset($_POST['username']) &&
        isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    }
	include "view/profile.php";
}
else if($action == "login") {
    include "view/login.php";
}
else if($action == "login_go") {
    $check = true;
    $id = -1;
    if(isset($_POST['username']) &&
        isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (false) { // check to see if user exists
            $check = true;
            //$id = get user id
        }
    }
    if ($check) {
        include "view/profile.php";
    }
    else {
        include "view/login.php";
    }
}
else if($action == "register") {
    include "view/register.php";
}
else{
    include "view/homepage.php";
}

?>
