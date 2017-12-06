<?php

function get_all_setlistsongs_by_performance($performanceid) {
    global $db;
    $query = "select * from setlistsong where performanceid = '$performanceid'";
    $query = $db->query($query);
    return $query;
}

?>