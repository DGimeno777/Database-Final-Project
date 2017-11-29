<?php

function get_tickets_sold_by_showId($showId) {
    global $db;
    $query = "select count(*) from ticket WHERE ShowID = '$showId'";
    $query = $db->query($query);
    return $query->fetch();
}

function create_ticket($showId, $userId) {
    
}