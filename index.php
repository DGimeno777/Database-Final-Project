<?php
//include "model/database.php";

if(isset($_GET['action'])){
    $action = $_POST['action'];
}
else{
    $action = "homepage";
}

if($action == "profile"){
	include "view/profile.php";
}
else{
    include "view/homepage.php";
}

?>
