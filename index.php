<?php
include "model/database.php";
include "model/user_db.php";
include "model/shows_db.php";
include "model/venue_db.php";
include "model/artist_db.php";
include "model/ticket_db.php";
include "model/performs_db.php";

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
        if (get_user_by_username_and_password($username,$password)->rowCount() > 0) { // check to see if user exists
            $check = true;
            $user = get_user_by_username_and_password($username, $password)->fetch();
            $id = $user["UserID"];
        }
        else {
            echo "User does not exist";
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
        isset($_POST['user_type']) &&
        isset($_POST['latitude']) &&
        isset($_POST['longitude'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user_type = $_POST['user_type'];
        $latitude = $_POST["latitude"];
        $longitude = $_POST["longitude"];
        $check = get_user_by_username($username);

        if ($check->rowCount() <= 0) {
            $check = true;
            register_user($username,$password,$user_type, $latitude, $longitude);
            $userAdded = get_user_by_username($username);
            $userAdded = $userAdded->fetch();
            $id = $userAdded["UserID"];
            
            if ($_POST['user_type'] == 'Artist') {
                add_artist_to_db($_POST['username'], $id);
            }
            if ($_POST['user_type'] == 'Venue') {
                add_venue_to_db($_POST['username'], $id);
            }
        }
        else {
            echo "User " . $username . " already exists";
        }
    }

    if ($check) {
        $user = get_user_by_userId($id);
        $user = $user->fetch();
        include "view/profile.php";
    }
    else {
        include "view/register.php";
    }
}
else if($action == "update_user_password") {
    if(isset($_POST["userID"])) {
        $userID = $_POST["userID"];
        if (isset($_POST["newpass"]) &&
            isset($_POST["newpassver"]) &&
            trim($_POST["newpass"]) != "" &&
            $_POST["newpass"] == $_POST["newpassver"]) {
            update_password($_POST["newpass"], $userID);
            echo "Password updated!";
        }
        $user = get_user_by_userId($userID);
        $user = $user->fetch();
        include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }

}
else if($action == "buy_ticket") {
    if (isset($_POST["userID"])) {
        $userID = $_POST["userID"];
        if (isset($_POST["showID"])) {
            $showID = $_POST["showID"];
            $show = get_show_by_showId($showID);
            $show = $show->fetch();
            $venue = get_venue_from_venueId($show["VenueID"]);
            $venue = $venue->fetch();
            $ticketsSold = get_tickets_sold_by_showId($showID);
            $ticketsSold = $ticketsSold["ticketcount"];
            $ticketsLeft = $venue["Capacity"] - $ticketsSold;
            if ($ticketsLeft > 0) {
                create_ticket($showID, $userID);
            }
            else {
                echo "Could not buy ticket - Show sold out!";
            }
        }
        $user = get_user_by_userId($userID);
        $user = $user->fetch();
        include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "add_show") {
    if (isset($_POST["userID"]) && isset($_POST["venueID"])) {
        $userID = $_POST["userID"];
        $user = get_user_by_userId($userID);
        $user = $user->fetch();
        $venueID = $_POST["venueID"];
        if (isset($_POST["showname"]) &&
            isset($_POST["showdate"]) &&
            isset($_POST["ticketprice"])) {
            $showname = $_POST["showname"];
            $showdate = $_POST["showdate"];
            $ticketprice = $_POST["ticketprice"];
            try {
                add_show($showname, $showdate, $ticketprice, $venueID);
            } catch(Exception $err) {
                echo $err;
            }
        }
        include "view/profile.php";
    }
    else{
        include "view/homepage.php";
    }
}
else{
    include "view/homepage.php";
}

?>
