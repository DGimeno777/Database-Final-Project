<?php
function get_headliner($showid) {
    global $db;
    $query = "select * from Shows join Performs using (ShowID) join Artist using (ArtistID) where Shows.ShowID = $showid and Headline = 'Headline';";
    $query = $db->query($query);
    return $query;
}

function get_opener($showid) {
    global $db;
    $query = "select * from Shows join Performs using (ShowID) join Artist using (ArtistID) where Shows.ShowID = $showid and Headline = 'Opener';";
    $query = $db->query($query);
    return $query;
}

function remove_performance_by_performanceId($performID) {
    global $db;
    $query = "delete from Performs where PerformanceID = '$performID'";
    $db->exec($query);
}

function get_performance_by_artistid_and_showid($artistID, $showID) {
    global $db;
    $query = "select * from performs where ArtistID = '$artistID' and ShowID = '$showID'";
    $query = $db->query($query);
    return $query;
}
