<?php
    $performance = get_performance_by_artistid_and_showid($artist["ArtistID"], $show["ShowID"])->fetch();
?>
<div>
    Add Song:
    <form method="post" action="./">
        <select name="songID">
            <?php foreach(get_all_songs_by_artistid($artist["ArtistID"]) as $song) :?>
                <option value="<?php echo $song["SongID"]; ?>">
                    <?php echo $song["SongName"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Add">
        <input type="hidden" name="action" value="add_sls">
        <input type="hidden" name="performanceID" value="<?php echo $performance["PerformanceID"];?>">
        <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
        <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
    </form>
</div>
<div>
    Set List:
    <div>
        <?php
            $sls = get_all_setlistsongs_by_performance($performance["PerformanceID"]);
        ?>
        <table>
            <tr>
                <th>
                    Song Name
                </th>
                <th>

                </th>
            </tr>
            <?php foreach($sls as $s) :?>
                <?php
                    $song = get_song_by_songid($s["SongID"])->fetch();
                ?>
                <tr>
                    <th>
                        <?php echo $song["SongName"];?>
                    </th>
                    <th>
                        <form method="post" action="./">
                            <input type="submit" value="Delete">
                            <input type="hidden" name="action" value="remove_sls">
                            <input type="hidden" name="slsID" value="<?php echo $s["SLSID"];?>">
                        </form>
                    </th>
                </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>