<?php

function get_all_shows() {
    global $db;
    $query = "select * from Shows";
    $query = $db->query($query);
    return $query;
}

//Use Case 1
function get_shows_by_month($month){
    global $db;
    $query = "select * from Shows where month(ShowDate) = '$month' order by ShowDate";
    $query = $db->query($query);
    return $query;
}

//Use Case 5
function add_artist_to_show($artist, $show, $headline){
    global $db;
    $query = "insert into Performance (ArtistID, ShowID, Headline) values ('$artist', '$show', '$headline');";
    $db->exec($query);
}

//Use Case 6
function remove_artist_from_show($artist, $show){
    global $db;
    $query = "delete from Performance where ArtistID = '$artist' and ShowID = '$show';";
    $db->exec($query);
}

//Use Case 10
function shows_for_artist_before_given_date($artistID, $showDate){
    global $db;
    $query = "select * from Performance natural join Shows where ArtistID = '$artistID' and ShowDate < '$showDate';";
    $query = $db->query($query);
    return $query;
}

//Use Case 11
function find_similar_artists($artistID){
    global $db;
    $query = "select * from Artist where Genre = (select Genre from Artist where ArtistID = '$artistID')";
    $query = $db->query($query);
    return $query;
}

//Use Case 14
function find_similar_artists_2($artistID){
    global $db;
    $query = "select count(*), Headline from Performance where ArtistID = '$artistID' group by Headline;";
    $query = $db->query($query);
    return $query;
}