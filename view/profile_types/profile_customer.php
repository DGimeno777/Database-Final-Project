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
            $show = get_show_by_showId($ticket["ShowID"]);
            $show = $show->fetch();
            $venue = get_venue_from_venueId($show["VenueID"]);
            $venue = $venue->fetch();
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
                    <?php echo $venue["Location"];?>
                </th>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<div>
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
        <?php foreach(get_all_shows() as $show) :?>
            <?php
            $venue = get_venue_from_venueId($show['VenueID']);
            $venue = $venue->fetch();
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
                    <?php echo $venue["Location"];?>
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