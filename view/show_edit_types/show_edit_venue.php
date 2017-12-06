<html>
<body>
<div>
    <form method="post" action="./">

    </form>
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
