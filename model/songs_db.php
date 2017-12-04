<?php
function remove_song_from_set_list($songID, $performanceID){
    global $db;
    $query = "Call remove_song_from_set_list('$songID', '$performanceID');";
    $db->exec($query);
}

function add_song_to_set_list($songID, $performanceID, $songOrder){
    global $db;
    $query = "Call add_song_to_set_list('$songID', '$performanceID', '$songOrder');";
    $db->exec($query);
}
