<?php
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

function add_show($showname, $year, $type){
    global $db;
    $query = "insert into shows (name, year, type) VALUES ('$showname', '$year', '$type')";
    $db->exec($query);
}
