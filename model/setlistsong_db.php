<?php

function get_all_setlistsongs_by_performance($performanceid) {
    global $db;
    $query = "select * from setlistsong where performanceid = '$performanceid'";
    $query = $db->query($query);
    return $query;
}

function get_sls_from_slsid($slsID) {
    global $db;
    $query = "select * from setlistsong where SLSID='$slsID'";
    $query = $db->query($query);
    return $query;
}

function remove_sls_by_slsid($slsID) {
    global $db;
    $query = "delete from setlistsong where SLSID='$slsID'";
    $db->exec($query);
}
?>