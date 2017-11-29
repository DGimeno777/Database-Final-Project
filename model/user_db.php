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
    echo $query;
    $db->exec($query);
}

function remove_song_from_setlist($songID, $performanceID){
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

