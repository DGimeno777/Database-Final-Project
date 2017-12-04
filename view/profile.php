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
    <div class="title">
        Update Password:
        <form action="./" method="post">
            <input type="hidden" name="action" value="update_user_password">
            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
            <input type="text" name="newpass">
            <input type="text" name="newpassver">
            <input type="submit" value="Update Password">
        </form>
    </div>
    <div class="catdiv">
        <?php
            include "profile_types/profile_" . strtolower($user['UserType']) . ".php";
        ?>
    </div>
</div>
<br>
<div class="positiondiv">
    <form action="./" method="post">
        <input class="button" type="submit" value="Homepage">
    </form>
</div>
</body>
</html>