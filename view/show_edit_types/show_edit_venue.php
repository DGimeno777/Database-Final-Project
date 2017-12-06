<html>
<body>
<div>
    <form method="post" action="./">
        <input type="text" name="showname" value="<?php echo $show["ShowName"]; ?>">
        <input type="date" name="showdate" value="<?php echo $show["ShowDate"];?>">
        <input type="number" name="ticketprice" value="<?php echo $show["TicketPrice"];?>">
        <input type="submit" value="Update">
        <input type="hidden" name="action" value="update_show">
        <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
        <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
    </form>
</div>
<div>
    Artists:
    <div>
        <?php
        $headliners = get_headliner($show["ShowID"]);
        $openers = get_opener($show["ShowID"]);
        ?>
        Headliners:
        <table>
            <tr>
                <th>Artist Name:</th>
                <th></th>
            </tr>
            <tr>
                <?php foreach($headliners as $headliner) :?>
                    <span><?php echo $headliner["ArtistName"];?></span>
                    <br>
                <?php endforeach;?>
            </tr>
        </table>
        <br>
        Openers:
        <table>
            <tr>
                <th>Artist Name:</th>
                <th></th>
            </tr>
            <tr>
                <?php foreach($openers as $opener) :?>
                    <th>
                        <?php echo $opener["ArtistName"];?>
                    </th>
                    <th>
                        <form>
                            <input type="submit" value="Remove Artist">
                            <input type="hidden" name="action" value="show_remove_artist">
                            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
                            <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
                            <input type="hidden" name="performID" value="<?php echo $opener["PerformanceID"];?>">
                        </form>
                    </th>
                <?php endforeach;?>
            </tr>
        </table>
    </div>
</div>
<div>
    Add Artist:
    <br>
    <form action="./" method="post">
        <?php
            $allArtists = get_all_artists();
        ?>
        <select name="add_artist">
            <?php foreach($allArtists as $artist) :?>
                <option value="<?php echo $artist["ArtistID"]; ?>">
                    <?php echo $artist["ArtistName"]; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <br>
        <input type="radio" name="artist_type" value="headliner"> Headliner<br>
        <input type="radio" name="artist_type" value="opener"> Opener
        <br>
        <input type="submit" value="Add">
        <input type="hidden" name="action" value="add_show_headline">
        <input type="hidden" name="showID" value="<?php echo $show["ShowID"];?>">
    </form>
</div>
<br>
<div>
    <form action="./" method="post">
        <input type="submit" value="Back to Profile">
        <input type="hidden" name="action" value="profile">
    </form>
</div>
</body>
</html>
