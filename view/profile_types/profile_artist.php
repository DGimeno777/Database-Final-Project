<?php
    $artist = get_artist_by_user_id($user["UserID"]);
    $artist = $artist->fetch();
?>
<div xmlns="http://www.w3.org/1999/html">
    Add Song:
    <div>
        <form method="post" action="./">
            <input type="text" name="songname">
            <input type="submit" value="Add Song">
            <input type="hidden" name="action" value="add_artist_song">
            <input type="hidden" name="artistID" value="<?php echo $artist["ArtistID"];?>">
        </form>
    </div>
    </br>
    Current Performances:
    <div>
        <?php
            $currShows = shows_after_today_by_aritst($artist["ArtistID"]);
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
            </tr>
           <?php foreach($currShows as $show) :?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>

                    </th>
                    <th>

                    </th>
                    <th>
                        <?php echo $show["TicketPrice"]; ?>
                    </th>
                </tr>
           <?php endforeach; ?>
        </table>
    </div>
    </br>
    Past Performances:
    <div>
        <?php
            $prevShows = shows_before_today_by_artist($artist["ArtistID"]);
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
            </tr>
            <?php foreach($prevShows as $show) :?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>

                    </th>
                    <th>

                    </th>
                    <th>
                        <?php echo $show["TicketPrice"]; ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>