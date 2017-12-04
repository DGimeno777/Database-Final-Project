<?php
    $venue = get_venue_by_user_id($user["UserID"]);
    $venue = $venue->fetch();
?>
<div xmlns="http://www.w3.org/1999/html">
    Add Show:
    <div>
        <form>
            <input type="text" name="showname">
            <input type="date" name="showdate">
            <input type="number" name="ticketprice">
            <!-- Not needed here
            <?php
                $allArtists = get_all_artists();
            ?>

            <select name="showArtist">
                <?php foreach($allArtists as $artist) :?>
                    <option value="<?php echo $artist["ArtistID"]; ?>">
                        <?php echo $artist["ArtistName"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>-->
        </form>
    </div>
    </br>
    Current Shows:
    <div>
        <?php
            $currShows = shows_after_today($venue["VenueID"]);
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
                    <?php $show["ShowName"]; ?>
                </th>
                <th>
                    <?php $show["ShowDate"]; ?>
                </th>
                <th>

                </th>
                <th>

                </th>
                <th>
                    <?php $show["TicketPrice"]; ?>
                </th>
            </tr>
        <?php endforeach; ?>
        </table>
    </div>
    </br>
    Past Shows:
    <div>
        <?php
            $prevShows = shows_before_today($venue["VenueID"]);
        ?>
        <?php foreach($currShows as $show) :?>

        <?php endforeach; ?>
    </div>
</div>