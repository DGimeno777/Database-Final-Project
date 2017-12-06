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
            $currShows = shows_after_today_by_artist($artist["ArtistID"]);
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
                    Setlist
                </th>
                <th>
                    Headline
                </th>
                <th>
                    Openers
                </th>
                <th>
                    Venue Name
                </th>
                <th>
                    Location
                </th>
                <th>
                    TicketPrice
                </th>
            </tr>
           <?php foreach($currShows as $show) :?>
               <?php
               $headliners = get_headliner($show["ShowID"]);
               $openers = get_opener($show["ShowID"]);
               $setlistsongs = get_all_setlistsongs_by_performance($show["PerformanceID"]);
               ?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>
                        <?php foreach($setlistsongs as $sls) :?>
                            <?php $sls = get_song_by_songid($sls)?>
                            <span><?php echo $sls["SongName"];?></span>
                            <br>
                        <?php endforeach; ?>
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
                        <?php echo $show["VenueName"];?>
                    </th>
                    <th>
                        <?php echo $show["Latitude"];?>
                        <br>
                        <?php echo $show["Longitude"];?>
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
                    Setlist
                </th>
                <th>
                    Headline
                </th>
                <th>
                    Openers
                </th>
                <th>
                    Venue Name
                </th>
                <th>
                    Location
                </th>
                <th>
                    TicketPrice
                </th>
            </tr>
            <?php foreach($prevShows as $show) :?>
                <?php
                $headliners = get_headliner($show["ShowID"]);
                $openers = get_opener($show["ShowID"]);
                $setlistsongs = get_all_setlistsongs_by_performance($show["PerformanceID"]);
                ?>
                <tr>
                    <th>
                        <?php echo $show["ShowName"]; ?>
                    </th>
                    <th>
                        <?php echo $show["ShowDate"]; ?>
                    </th>
                    <th>
                        <?php foreach($setlistsongs as $sls) :?>
                            <?php $sls = get_song_by_songid($sls)?>
                            <span><?php echo $sls["SongName"];?></span>
                            <br>
                        <?php endforeach; ?>
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
                        <?php echo $show["VenueName"];?>
                    </th>
                    <th>
                        <?php echo $show["Latitude"];?>
                        <br>
                        <?php echo $show["Longitude"];?>
                    </th>
                    <th>
                        <?php echo $show["TicketPrice"]; ?>
                    </th>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>