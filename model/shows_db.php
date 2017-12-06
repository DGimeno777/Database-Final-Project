<?php

function get_all_shows() {
    global $db;
    $query = "select * from Shows";
    $query = $db->query($query);
    return $query;
}

function get_show_by_showId($showId) {
    global $db;
    $query = "select * from shows where ShowID = '$showId'";
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
    $query = "insert into Performs (ArtistID, ShowID, Headline) values ('$artist', '$show', '$headline');";
    $db->exec($query);
}

//Use Case 6
function remove_artist_from_show($artist, $show){
    global $db;
    $query = "delete from Performs where ArtistID = '$artist' and ShowID = '$show';";
    $db->exec($query);
}

//Use Case 10
function shows_for_artist_before_given_date($artistID, $showDate){
    global $db;
    $query = "select * from Performs natural join Shows where ArtistID = '$artistID' and ShowDate < '$showDate';";
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

//Use Case 14 The number of times an artist has headlined
function number_times_headlined($artistID){
    global $db;
    $query = "select count(*), Headline from Performs where ArtistID = '$artistID' group by Headline;";
    $query = $db->query($query);
    return $query;
}

function add_show($showname, $showdate , $ticketPrice, $venueID){
    global $db;
    $query = "insert into shows (ShowName, Showdate, TicketPrice, VenueID) VALUES ('$showname', '$showdate', '$ticketPrice', '$venueID');";
    $db->exec($query);
}

function shows_before_today($venueid){
    global $db;
    $query = "select * from shows join Venue using (VenueID) where ShowDate < NOW() and Venue.venueid = $venueid;";
    $query = $db->query($query);
    return $query;
}


function shows_after_today($venueid){
    global $db;
    $query = "select * from shows join Venue using (VenueID) where ShowDate >= NOW() and Venue.venueid = $venueid;";
    $query = $db->query($query);
    return $query;
}






















