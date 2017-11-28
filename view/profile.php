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
        <?php echo $user['UserName']; ?>
    </div>
    <div class="catdiv">
        <?php if($user['UserType'] == "customer") :?>
            <div>
                Bought Tickets:
                <table>
                    <tr>
                        <th>
                            Show name
                        </th>
                        <th>
                            Section
                        </th>
                        <th>
                            Show Date
                        </th>
                        <th>
                            Venue Name
                        </th>
                        <th>
                            Venue Location
                        </th>
                    </tr>
                </table>
            </div>
            <div>
                <table>
                    <tr>
                        <th>
                            Showname
                        </th>
                        <th>
                            Date
                        </th>
                        <th>
                            Ticket Price
                        </th>
                        <th>
                            Venue
                        </th>
                        <th>
                            Tickets Left
                        </th>
                    </tr>

                    <tr>

                    </tr>
                </table>
            </div>
        <?php elseif($user['UserType'] == "artist") :?>
            <div>
                <table>
                    <tr>

                    </tr>
                </table>
            </div>
        <?php elseif($user['UserType'] == "venue") :?>
            <div>
                <table>

                </table>
            </div>
        <?php endif; ?>
    </div>
</div>
<br>
<div class="positiondiv">
    <form action="./" method="post">
        <input class="button" type="submit" value=" Search ">
        <input class="hidden" type="hidden" name="action" value="search">
    </form>
    <form action="./" method="post">
        <input class="button" type="submit" value="Homepage">
    </form>
</div>
</body>
</html>