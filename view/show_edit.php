<?php
// Placeholder for show editing page
?>
<html xmlns="http://www.w3.org/1999/html">
<style>
    head{
        margin-top: 10em;
    }
    .title{
        margin-top: 5em;
        text-align: left;
        font-size: 20px;
    }
    .catdiv{
        text-align: left;
    }
    .showdiv{
        margin-left: 5%;
    }
    .infodiv{
        margin-left: 10%;
    }
    .positiondiv{
        margin-left: auto;
        margin-right: auto;
        width: 40em;
        text-align: center;
        margin-top: 1em;
    }

    .hidden{
        display: none;
    }

    .button{
        width: 7em;
        margin-top: -1em;
    }

</style>
<head>

</head>
<body style="display: inline">
<div class="positiondiv">
    <div class="title">
        <?php echo $user['UserName']?>
        <br>
        <?php echo $user['UserType']?>
    </div>
    <div>
        <?php
        if(strtolower($user["UserType"]) == "artist"){
            $artist = get_artist_by_user_id($user["UserID"])->fetch();
            include "show_edit_types/show_edit_artist.php";
        }
        elseif (strtolower($user["UserType"]) == "venue") {
            $venue = get_venue_by_user_id($user["UserID"])->fetch();
            include "show_edit_types/show_edit_venue.php";
        }?>
    </div>
</div>
<br>
<div class="positiondiv">
    <form action="./" method="post">
        <input type="submit" value="Back to Profile">
        <input type="hidden" name="action" value="profile">
        <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
    </form>
    <br>
    <form action="./" method="post">
        <input class="button" type="submit" value="Homepage">
    </form>
</div>
</body>
</html>
