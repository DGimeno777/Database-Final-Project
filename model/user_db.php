<?php

function get_user_by_username_and_password($username, $password) {
    global $db;
    $query = "select * from users where username = '$username' and pass = '$password'";
    $query = $db->query($query);
    return $query;
}

function get_user_by_username($username) {
    global $db;
    $query = "select * from users where username = '$username'";
    $query = $db->query($query);
    return $query;
}

function get_user_by_userId($userId) {
    global $db;
    $query = "select * from users where userid = '$userId'";
    $query = $db->query($query);
    return $query;
}

function register_user($username, $password, $type) {
    global $db;
    $query = "insert into users (username, pass, usertype) VALUES ('$username','$password','$type')";
    $db->exec($query);
}

function update_password($password, $userID){
    global $db;
    $query = "update Users set Pass = '$password' where UserID = '$userID';";
    $db->exec($query);
}

//Not Done
function find_close_venues($venueName){
    global $db;
    $query = "select * from Venue where VenueName = '$venueName'";
    $db->exec($query);
}
