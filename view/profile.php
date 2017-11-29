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
        <?php echo $user['UserName']; ?>
    </div>
    <div class="title">
        <?php echo $user['UserType']?>
    </div>
    <div class="catdiv">
        <?php if($user['UserType'] == "Customer") :?>
            <div>
                Bought Tickets:
                <table>
                    <tr>
                        <th>
                            Show Name
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
                    <?php foreach(tickets as $ticket) : ?>
                        <?php
                            $show = get_show_by_showId($ticket["ShowID"]);
                        ?>
                    <tr>
                        <th>

                        </th>
                        <th>
                            <?php echo $ticket["Sections"]; ?>
                        </th>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div>
                Shows:
                <table>
                    <tr>
                        <th>
                            Show Name
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
                            Venue Location
                        </th>
                        <th>
                            Tickets Left
                        </th>
                        <th>
                            <!-- Buy ticket -->
                        </th>
                    </tr>
                    <?php foreach(get_all_shows() as $show) :?>
                        <?php
                            $venue = get_venue_from_venueId($show['VenueID']);
                            $venue = $venue->fetch();
                        ?>
                    <tr>
                        <th>
                            <?php echo $show["ShowName"];?>
                        </th>
                        <th>
                            <?php echo $show["ShowDate"];?>
                        </th>
                        <th>
                            <?php echo $show["TicketPrice"];?>
                        </th>
                        <th>
                            <?php echo $venue["VenueName"];?>
                        </th>
                        <th>
                            <?php echo $venue["Location"];?>
                        </th>
                        <th>
                            <?php echo intval($venue["Capacity"]);?>
                        </th>
                        <th>
                            <form action="./" method="post">
                                <input type="submit" name="Buy" value="Buy">
                                <input type="hidden" name="action" value="buy_ticket">
                                <input type="hidden" name="userID" value="<?php echo $user["UserID"]?>">
                                <input type="hidden" name="showID" value="<?php echo $show["ShowID"]?>">
                            </form>
                        </th>
                    </tr>
                    <?php endforeach;?>
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