<?php
    $venue = get_venue_by_user_id($user["UserID"]);
    $venue = $venue->fetch();
?>
<div xmlns="http://www.w3.org/1999/html">
    Add Show:
    <div>
        <form action="./" method="post">
            <input type="text" name="showname">
            <input type="date" name="showdate">
            <input type="number" name="ticketprice">
            <input type="submit" name="Add Show">
            <input type="hidden" name="action" value="add_show">
            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
            <input type="hidden" name="venueID" value="<?php echo $venue["VenueID"];?>">
        </form>
    </div>
    </br>
    Current Shows:
    <div>
        <?php
            $currShows = shows_after_today_by_venue($venue["VenueID"]);
        ?>
        <table>
            <tr>
                <th>
                    ShowName
                </th>
                <th>
                    Date
                </th>
                <th>
                    Headline
                </th>
                <th>
                    Openers
                </th>
                <th>
                    TicketPrice
                </th>
                <th>
                    Edit Show
                </th>
            </tr>
           <?php foreach($currShows as $show) :?>
               <?php
                    $headliners = get_headliner($show["ShowID"]);
                    $openers = get_opener($show["ShowID"]);
               ?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>
                        <?php foreach($headliners as $headliner) :?>
                            <span><?php echo $headliner["ArtistName"];?></span>
                            <br>
                        <?php endforeach;?>
                    </th>
                    <th>
                        <?php foreach($openers as $opener) :?>
                            <span><?php echo $opener["ArtistName"];?></span>
                            <br>
                        <?php endforeach;?>
                    </th>
                    <th>
                        <?php echo $show["TicketPrice"]; ?>
                    </th>
                    <th>
                        <form action="./" method="post">
                            <input type="submit" value="Edit">
                            <input type="hidden" name="action" value="show_edit">
                            <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
                            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
                        </form>
                    </th>
                </tr>
           <?php endforeach; ?>
        </table>
    </div>
    </br>
    Past Shows:
    <div>
        <?php
            $prevShows = shows_before_today_by_venue($venue["VenueID"]);
        ?>
        <table>
            <tr>
                <th>
                    ShowName
                </th>
                <th>
                    Date
                </th>
                <th>
                    Headline
                </th>
                <th>
                    Openers
                </th>
                <th>
                    TicketPrice
                </th>
                <th>
                    Edit Show
                </th>
            </tr>
            <?php foreach($prevShows as $show) :?>
                <?php
                $headliners = get_headliner($show["ShowID"]);
                $openers = get_opener($show["ShowID"]);
                ?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>
                        <?php foreach($headliners as $headliner) :?>
                            <span><?php echo $headliner["ArtistName"];?></span>
                            <br>
                        <?php endforeach;?>
                    </th>
                    <th>
                        <?php foreach($openers as $opener) :?>
                            <span><?php echo $opener["ArtistName"];?></span>
                            <br>
                        <?php endforeach;?>
                    </th
                    <th>
                        <?php echo $show["TicketPrice"]; ?>
                    </th>
                    <th>
                        <form action="./" method="post">
                            <input type="submit" value="Edit">
                            <input type="hidden" name="action" value="show_edit">
                            <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
                            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
                        </form>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>