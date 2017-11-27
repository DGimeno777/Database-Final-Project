<?php
function remove_song_from_set_list($songID, $performanceID){
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
