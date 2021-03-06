<?php
include "model/database.php";
include "model/user_db.php";
include "model/shows_db.php";
include "model/venue_db.php";
include "model/artist_db.php";
include "model/ticket_db.php";
include "model/performs_db.php";
include "model/setlistsong_db.php";
include "model/songs_db.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
}
else{
    $action = "homepage";
}

if($action == "profile"){
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
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
        isset($_POST['latitude']) && $_POST['latitude'] != "" &&
        isset($_POST['longitude']) && $_POST['longitude'] != "" ) {
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
else if($action == "show_edit") {
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            $show = get_show_by_showId($_POST["showID"])->fetch();
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "add_sls") {
    if(isset($_POST["performanceID"]) && isset($_POST["songID"])) {
        echo $_POST["songID"] . "," . $_POST["performanceID"];
        add_song_to_set_list($_POST["songID"], $_POST["performanceID"], 0);
    }
    if (isset($_POST["userID"])){
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            $show = get_show_by_showId($_POST["showID"])->fetch();
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "remove_sls") {
    if (isset($_POST["slsID"])) {
        remove_sls_by_slsid($_POST["slsID"]);
    }
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            $show = get_show_by_showId($_POST["showID"])->fetch();
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else {
        include "view/homepage.php";
    }
}
else if ($action == "update_show") {
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            if (isset($_POST["showname"]) &&
                isset($_POST["showdate"]) &&
                isset($_POST["ticketprice"])) {
                $showname = $_POST["showname"];
                $showdate = $_POST["showdate"];
                $ticketprice = $_POST["ticketprice"];
                update_show($_POST["showID"], $showname, $showdate, $ticketprice);
            }
            $show = get_show_by_showId($_POST["showID"])->fetch();
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else{
        include "view/homepage.php";
    }
}
else if ($action == "add_show_artist") {
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            $show = get_show_by_showId($_POST["showID"])->fetch();
            if (isset($_POST["add_artist"]) && isset($_POST["artist_type"])) {
                add_artist_to_show($_POST["add_artist"], $_POST["showID"], $_POST["artist_type"]);
            }
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "show_remove_artist") {
    if (isset($_POST["performID"])) {
        $performID = $_POST["performID"];
        remove_performance_by_performanceId($performID);
    }
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        if (isset($_POST["showID"])) {
            $show = get_show_by_showId($_POST["showID"])->fetch();
            include "view/show_edit.php";
        }
        else {
            include "view/profile.php";
        }
    }
    else {
        include "view/homepage.php";
    }
}
else if ($action == "add_artist_song") {
    if (isset($_POST["artistID"])) {
        $user = get_user_by_artistid($_POST["artistID"])->fetch();
        if(isset($_POST["songname"])) {
            add_new_song_for_artist($_POST["artistID"], $_POST["songname"]);
        }
        include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }
}
else if ($action == "remove_artist_song") {
    if (isset($_POST["songID"])) {
        remove_song($_POST["songID"]);
    }
    if (isset($_POST["artistID"])) {
        $user = get_user_by_artistid($_POST["artistID"])->fetch();
        include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }
}
else if($action == "filter_shows") {
    if (isset($_POST["userID"])) {
        $user = get_user_by_userId($_POST["userID"])->fetch();
        $filteredShows = get_all_shows();
        if (isset($_POST["filter_type"]) && isset($_POST["filter_date"]) && isset($_POST["showdate"])) {
            $filterType = $_POST["filter_type"];
            $userID = -1;
            if ($filterType == "artist") {
                $userID = get_user_by_artistid($_POST["artistID"])->fetch()["UserID"];
            }
            else {
                $userID = get_user_by_venueid($_POST["venueID"])->fetch()["UserID"];
            }
            $filteredShows = get_filtered_shows($userID, $filterType, $_POST["showdate"], $_POST["filter_date"]);
        }
        include "view/profile.php";
    }
    else {
        include "view/homepage.php";
    }
}
else{
    include "view/homepage.php";
}

?>
