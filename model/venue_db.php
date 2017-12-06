<?php

function get_venue_from_venueId($venueId) {
    global $db;
    $query = "select * from venue WHERE VenueID = '$venueId'";
    $query = $db->query($query);
    return $query;
}

function get_average_venue_capacity($artistID){
    global $db;
    $query = "select avg(Capacity) from Performs natural join Shows natural join Venue where ArtistID = '$artistID'";
    $query = $db->query($query);
    return $query;
}

function get_showname_by_id($id){
    global $db;
    $query = "select name from shows where id = '$id'";
    $query = $db->query($query);
    return $query->fetch()['name'];
}

function get_venue_by_user_id($userID){
    global $db;
    $query = "select * from Venue where UserID = '$userID'";
    $query = $db->query($query);
    return $query;
}

//Use Case 5 (Venue adds an artist to a show)
//this has a procedure
/*function add_artist_to_show($artist, $show, $headline){
    global $db;
    $query = "insert into Performs (ArtistID, ShowID, Headline) values ('$artist', '$show', '$headline');";
    $db->exec($query);
}

//Use Case 6 (A venue wants to remove a list of artists from a specific show)
function remove_artist_from_show($artist, $show){
    global $db;
    $query = "delete from Performs where ArtistID = '$artist' and ShowID = '$show';";
    $db->exec($query);
}

//Use Case 11 (a venue wants to see artists similar to the given one to find a headliner/opener for a show
function find_similar_artists($artistID){
    global $db;
    $query = "select * from Artist where Genre = (select Genre from Artist where ArtistID = '$artistID')";
    $query = $db->query($query);
    return $query;
}*/

