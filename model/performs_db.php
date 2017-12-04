<?php
function get_headliner($showid) {
    global $db;
    $query = "select ArtistName from Shows join Performs using (ShowID) join Artist using (ArtistID) where Shows.ShowID = $showid and Headline = 'Headline';";
    $query = $db->query($query);
    return $query;
}

function get_opener($showid) {
    global $db;
    $query = "select ArtistName from Shows join Performs using (ShowID) join Artist using (ArtistID) where Shows.ShowID = $showid and Headline = 'Opener';";
    $query = $db->query($query);
    return $query;
}
}