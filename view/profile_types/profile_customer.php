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
        <?php foreach(tickets_purchased_by_user($user["UserID"]) as $ticket) : ?>
            <?php
            $show = get_show_by_showId($ticket["ShowID"])->fetch();
            $venue = get_venue_from_venueId($show["VenueID"])->fetch();
            $venue_user = get_user_by_venueid($show["VenueID"])->fetch();
            ?>
            <tr>
                <th>
                    <?php echo $show["ShowName"];?>
                </th>
                <th>
                    <?php echo $ticket["Sections"]; ?>
                </th>
                <th>
                    <?php echo $show["ShowDate"];?>
                </th>
                <th>
                    <?php echo $venue["VenueName"];?>
                </th>
                <th>
                    <?php echo $venue_user["Longitude"] . "," . $venue_user["Latitude"];?>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<br>
<div>
    <div>
        Filter:
        <form method="post" action="./">
            <?php
                $allArtists = get_all_artists();
                $allVenues = get_all_venues();
            ?>
            Artist:
            <select name="artistID">
                <?php foreach($allArtists as $artist) :?>
                    <option value="<?php echo $artist["ArtistID"]; ?>">
                        <?php echo $artist["ArtistName"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            Venue
            <select name="venueID">
                <?php foreach($allVenues as $venue) :?>
                    <option value="<?php echo $venue["VenueID"]; ?>">
                        <?php echo $venue["VenueName"]; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br>
            Filter by:
            <input type="radio" name="filter_type" value="venue"> Venue
            <input type="radio" name="filter_type" value="artist"> Artist
            <br>
            Showdate:
            <input type="date" name="showdate">
            <br>
            Before or After the date:
            <input type="radio" name="filter_date" value="after"> After Date
            <input type="radio" name="filter_date" value="before"> Before Date
            <br>
            <input type="submit" value="Filter">
            <input type="hidden" name="action" value="filter_shows">
            <input type="hidden" name="userID" value="<?php echo $user["UserID"];?>">
        </form>
    </div>
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
        <?php
            $show_shows = isset($filteredShows) ? $filteredShows : get_all_shows();
        ?>
        <?php foreach(shows_after_today() as $show) :?>
            <?php
            $venue = get_venue_from_venueId($show['VenueID'])->fetch();
            $venue_user = get_user_by_venueid($venue["VenueID"])->fetch();
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
                    <?php echo $venue_user["Longitude"] . "," . $venue_user["Latitude"];?>
                </th>
                <th>
                    <?php
                    $ticketsSold = get_tickets_sold_by_showId($show["ShowID"]);
                    $ticketsSold = $ticketsSold["ticketcount"];
                    echo intval($venue["Capacity"]) - $ticketsSold;
                    ?>
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