<?php

function get_userId_by_username_and_password($username, $password) {
    global $db;
    $query = "select id from users where username = '$username' and password = '$password'";
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
    $query = $db->query($query)->fetch();
    return $query;
}

function register_user($username, $password, $type) {
    global $db;
    $query = "insert into users (username, password, usertype) VALUES ('$username','$password','$type')";
    $db->exec($query);
}

function purchase_tickets($songID, $performanceID){
    global $db;
    $query = "delete from SetListSong where SongID = '$songID' and PerformanceID = '$performanceID';";
    $query = $db->query($query);
    return $query;
}

function add_song_to_set_list($songID, $performanceID, $songOrder){
    global $db;
    $query = "insert into SetListSong (SongID, PerformanceID, SongOrder) values ('$songID', '$performanceID', '$songOrder');";
    $query = $db->query($query);
    return $query->fetch()['name'];
}

//Not Done
function find_close_venues($venueName){
    global $db;
    $query = "select * from Venue where VenueName = '$venueName'";
    $db->exec($query);
}

