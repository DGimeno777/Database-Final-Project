<?php
    $artist = get_artist_by_user_id($user["UserID"]);
    $artist = $artist->fetch();
?>
<div xmlns="http://www.w3.org/1999/html">
    Add Song:
    <div>
        <form>
            <input type="text" name="songname">
            <input type="text" name="performancename">
            <input type="number" name="songorder">
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
    Current Performances:
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
            $prevShows = shows_before_today($venue["VenueID"]);
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