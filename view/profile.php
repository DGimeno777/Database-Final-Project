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
        width: 15em;
        text-align: left;
    }

    .button{
        width: 7em;
        margin-top: -1em;
    }

</style>
<head>

</head>
<body>
<div class="positiondiv">
    <div class="title">
        Username
    </div>
    <div class="catdiv">
        User Type
    </div>
    <div class="catdiv">
        Edit Stuff:
    </div>
    <div class="catdiv">
        Look at shows/stuff
    </div>
</div>
<br>
<div class="positiondiv">
	Buttons to go places
    <form action="./" method="post">
        <input class="button" type="submit" value=" Search ">
        <input type="hidden" name="action" value="search">
    </form>
    <form action="./" method="post">
        <input class="button" type="submit" value="Homepage">
    </form>
</div>
</body>
</html>