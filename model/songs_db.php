<?php
function remove_song_from_set_list($songID, $performanceID){
    global $db;
    $query = "Call remove_song_from_set_list('$songID', '$performanceID');";
    $db->exec($query);
}

function add_song_to_set_list($songID, $performanceID, $songOrder){
    global $db;
    $query = "Call add_song_to_set_list('$songID', '$performanceID');";
    $db->exec($query);
}

function get_song_by_songid($songid) {
    global $db;
    $query = "select * from song where songid = '$songid'";
    $query = $db->query($query);
    return $query;
}

function add_new_song_for_artist($artistID, $songname) {
    global $db;
    $query = "insert into song (SongName, ArtistID) values ('$songname', '$artistID');";
    $db->exec($query);
}

function get_all_songs_by_artistid($artistID) {
    global $db;
    $query = "select * from song where artistid = '$artistID'";
    $query = $db->query($query);
    return $query;
}

function remove_song($songID) {
    global $db;
    $query = "Delete from song where songid = '$songID'";
    $db->exec($query);
}