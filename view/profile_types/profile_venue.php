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
            $currShows = [];
        ?>
        <?php foreach($currShows as $show) :?>
            <table>
                <tr>
                    <th>
                        ShowName
                    </th>
                    <th>
                        Date
                    </th>
                    <th>
                        TicketPrice
                    </th>
                    <th>
                        Headline
                    </th>
                    <th>
                        Openers
                    </th>
                </tr>
            </table>
        <?php endforeach; ?>
    </div>
    </br>
    Past Shows:
    <div>
        <?php
            $prevShows = [];
        ?>
        <?php foreach($currShows as $show) :?>

        <?php endforeach; ?>
    </div>
</div>