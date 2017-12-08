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

function get_all_venues(){
    global $db;
    $query = "select * from Venue;";
    $query = $db->query($query);
    return $query;
}


