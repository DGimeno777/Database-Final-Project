<?php
/*
function remove_song_from_set_list($songID, $performanceID){
    global $db;
    $query = "Call remove_song_from_set_list('$songID', '$performanceID');";
    $db->exec($query);
}

function add_song_to_set_list($songID, $performanceID, $songOrder){
    global $db;
    $query = "Call add_song_to_set_list('$songID', '$performanceID', '$songOrder');";
    $db->exec($query);
}*/

//Gets all the artists in the database
function get_all_artists(){
    global $db;
    $query = "select * from Artist;";
    $query = $db->query($query);
    return $query;
}

function get_artist_by_user_id($userID){
    global $db;
    $query = "select * from Artist where UserID = '$userID'";
    $query = $db->query($query);
    return $query;
}

function get_artist_by_artistid($artistID){
    global $db;
    $query = "select * from Artist where ArtistID = '$artistID'";
    $query = $db->query($query);
    return $query;
}

function add_artist_to_db($artistName, $userID){
    global $db;
    $query = "insert into Artist (ArtistName, UserID) values ('$artistName', '$userID');";
    $query = $db->query($query);
    return $query;
}