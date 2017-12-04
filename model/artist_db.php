<?php
function remove_song_from_set_list($songID, $performanceID){
    global $db;
    $query = "Call remove_song_from_set_list($songID, $performanceID);";
    $db->exec($query);
}

function add_song_to_set_list($songID, $performanceID, $songOrder){
    global $db;
    $query = "Call add_song_to_set_list($songID, $performanceID, $songOrder);";
    $db->exec($query);
}

//Not Done
function find_close_venues($venueName){
    global $db;
    $query = "select * from Venue where VenueName = '$venueName'";
    $db->exec($query);
}

//Gets all the artists in the database
function get_all_artists(){
    global $db;
    $query = "select * from Artist;";
    $db->exec($query);
}