<?php
include "model/database.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
}
else{
    $action = "homepage";
}

if(false){
}
else{
    include "view/homepage.php";
}

?>
