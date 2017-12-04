
DROP DATABASE IF EXISTS databasefinal;
CREATE DATABASE databasefinal;
use databasefinal;

create table Users
(
UserID INT PRIMARY KEY auto_increment,
UserName varchar(100),
Pass varchar(50),
UserType ENUM ('Artist', 'Customer', 'Venue'),
Latitude float,
Longitude float,

Check (Latitude >= -90),
Check (Latitude <= 90),
Check (Longitude >= -180),
Check (Longitude <= 180)

);

create table Artist
(
ArtistID 	 INT	 	PRIMARY KEY auto_increment,
UserID INT,
ArtistName varchar(100),
Genre varchar(100),

CONSTRAINT artist_user_fk
FOREIGN KEY (UserID)
	REFERENCES Users (UserID)
);

create table Venue 
(
VenueID INT PRIMARY KEY auto_increment,
UserID INT,
VenueName varchar(100),
Capacity INT,

CONSTRAINT venue_user_fk
FOREIGN KEY (UserID)
	REFERENCES Users (UserID)
);

create table Shows
(
ShowID INT PRIMARY KEY auto_increment,
ShowName varchar(100),
ShowDate Date,
TicketPrice INT,
VenueID INT,

CONSTRAINT Venue_fk
	FOREIGN KEY (VenueID)
	REFERENCES Venue (VenueID)
    
);

create table Performs
(
PerformanceID int PRIMARY KEY auto_increment,
ArtistID INT,
ShowID INT,
Headline ENUM ('Headline', 'Opener'),


CONSTRAINT artist_fk
	FOREIGN KEY (ArtistID)
	REFERENCES Artist (ArtistID),
    
CONSTRAINT show_fk
	FOREIGN KEY (ShowID)
	REFERENCES Shows (ShowID)
);

create table Song 
(
SongID int PRIMARY KEY auto_increment,
SongName varchar(100),
ArtistID int,

CONSTRAINT artist_song_fk
FOREIGN KEY (ArtistID)
	REFERENCES Artist (ArtistID)
);



create table SetListSong
(
SLSID int PRIMARY KEY auto_increment,
SongID int,
PerformanceID int,
SongOrder int,

CONSTRAINT song_fk
FOREIGN KEY (SongID)
	REFERENCES Song (SongID),
    
CONSTRAINT performance_fk
FOREIGN KEY (PerformanceID)
	REFERENCES Performs (PerformanceID)    
);

create table Ticket
(
TicketID int PRIMARY KEY auto_increment,
Sections varchar(100),
UserID int,
ShowID int,

CONSTRAINT ticket_user_fk
FOREIGN KEY (UserID)
	REFERENCES Users (UserID),
    
CONSTRAINT ticket_shows_fk
FOREIGN KEY (ShowID)
	REFERENCES Shows (ShowID)    
);


insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('U2', 'password1', 'Artist', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('Killers', 'password1', 'Artist', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('AlexC', 'password1', 'Artist', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('LanaBanana', 'password1', 'Artist', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('JAiko', 'password1', 'Artist', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('TD', 'password1', 'Venue', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('BOK', 'password1', 'Venue', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('HOB', 'password1', 'Venue', 42.3601, 71.0589);
insert into Users (UserName, Pass, UserType, Latitude, Longitude) values ('JHALL', 'password1', 'Venue', 42.3601, 71.0589);

insert into Venue (VenueName, Capacity, UserID) values ('TD Garden', 19580, 6);
insert into Venue (VenueName, Capacity, UserID) values ('Bok Center', 10, 7);
insert into Venue (VenueName, Capacity, UserID) values ('House of Blues', 2500, 8);
insert into Venue (VenueName, Capacity, UserID) values ('Jordan Hall', 1019, 9);

insert into Artist (ArtistName, Genre, UserID) values ('U2', 'Alternative Rock', 1);
insert into Artist (ArtistName, Genre, UserID) values ('The Killers', 'Rock', 2);
insert into Artist (ArtistName, Genre, UserID) values ('Alex Cameron', 'Electropop', 3);
insert into Artist (ArtistName, Genre, UserID) values ('Lana Del Rey', 'Indie', 4);
insert into Artist (ArtistName, Genre, UserID) values ('Jhene Aiko', 'R and B', 5);

insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('U2 at TD Garden', '2018-6-21', 41, 1);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('U2 back at it Garden', '2018-6-22', 41, 1);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('U2 are BOK', '2018-5-2', 20, 2);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Killin IT', '2018-1-7', 20.5, 1);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Lana at the Garden', '2018-1-13', 35, 1);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Lana is Blue', '2018-2-17', 40, 3);

insert into Performs (ArtistID, ShowID, Headline) values (1, 1, 'Headline');
insert into Performs (ArtistID, ShowID, Headline) values (1, 2, 'Headline');
insert into Performs (ArtistID, ShowID, Headline) values (1, 3, 'Headline');
insert into Performs (ArtistID, ShowID, Headline) values (2, 4, 'Headline');
insert into Performs (ArtistID, ShowID, Headline) values (3, 4, 'Opener');
insert into Performs (ArtistID, ShowID, Headline) values (4, 5, 'Headline');
insert into Performs (ArtistID, ShowID, Headline) values (5, 5, 'Opener');

DROP TRIGGER IF EXISTS max_ticket_limit;

DELIMITER //
CREATE TRIGGER max_ticket_limit
	BEFORE insert ON Ticket
    FOR EACH ROW
BEGIN
	DECLARE ticket_count INT;
    DECLARE venue_capacity INT;
    
	select count(*) 
		into ticket_count
			from Ticket 
				where ShowID = 
					New.ShowID;
                
	select Capacity 
		into venue_capacity
			from Shows natural join Venue 
				where ShowID = New.ShowID;
            
	IF (venue_capacity < ticket_count) THEN
			SIGNAL SQLSTATE 'HY000'
				SET MESSAGE_TEXT = 'Show is sold out';
	END IF;
END; //
DELIMITER ;

DROP TRIGGER IF EXISTS insert_song_order;

DELIMITER $$
CREATE TRIGGER insert_song_order
	BEFORE insert ON SetListSong
    FOR EACH ROW
BEGIN
	
    IF (New.SongOrder in (select SongOrder from SetListSong where PerformanceID = New.PerformanceID)) THEN
		SIGNAL SQLSTATE 'HY000'
				SET MESSAGE_TEXT = 'There is already a song being performed at this time';
	END IF;
    
END; $$
DELIMITER;

DROP TRIGGER IF EXISTS update_song_order;

DELIMITER //
CREATE TRIGGER update_song_order
	BEFORE update ON SetListSong
    FOR EACH ROW
BEGIN
	
    IF (New.SongOrder in (select SongOrder from SetListSong where PerformanceID = New.PerformanceID)) THEN
		SIGNAL SQLSTATE 'HY000'
				SET MESSAGE_TEXT = 'There is already a song being performed at this time';
	END IF;
    
END; //
DELIMITER;

DROP FUNCTION IF EXISTS get_tickets_by_user;
DELIMITER //

CREATE FUNCTION get_tickets_by_user
(
   user_ID int
)
RETURNS INT
BEGIN
  DECLARE ticket_count INT;
  
  select count(*) 
	into ticket_count
		from Ticket 
			where UserID =  user_ID;
  
  RETURN(ticket_count);
END//

DELIMITER ;

DROP PROCEDURE IF EXISTS remove_song_from_set_list;
DELIMITER //
CREATE PROCEDURE remove_song_from_set_list
(
	song_ID int, performance_ID int
)
BEGIN

	delete from SetListSong where SongID = song_ID and PerformanceID = performance_ID;
 
END //
DELIMITER;

DROP PROCEDURE IF EXISTS add_song_to_set_list;
DELIMITER //
CREATE PROCEDURE add_song_to_set_list
(
	song_ID int, performance_ID int, song_order int
)
BEGIN

	insert into SetListSong (SongID, PerformanceID, SongOrder) values (song_ID, performance_ID, song_order);
 
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS add_song_to_set_list;
DELIMITER //
CREATE PROCEDURE add_song_to_set_list
(
	song_ID int, performance_ID int, song_order int
)
BEGIN

	insert into SetListSong (SongID, PerformanceID, SongOrder) values (song_ID, performance_ID, song_order);
 
END //
DELIMITER ;


-- START ticket_db.php-------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS get_tickets_sold_by_showId;
DELIMITER //
CREATE PROCEDURE get_tickets_sold_by_showId($showId int)
BEGIN

 select count(*) as ticketcount from ticket WHERE ShowID = $showId;
 
END //
DELIMITER ;


DROP PROCEDURE IF EXISTS create_ticket;
DELIMITER //
CREATE PROCEDURE create_ticket($showId int, $userId int)
BEGIN

insert into ticket (Sections, UserID, ShowID) VALUES ('GA','$userId','$showId');

END //
DELIMITER ;


DROP PROCEDURE IF EXISTS tickets_purchased_by_user;

DELIMITER //
CREATE PROCEDURE tickets_purchased_by_user($userId int)
BEGIN

	select * from Ticket where UserID =  $userID;

END //
DELIMITER ;

DROP PROCEDURE IF EXISTS get_user;

DELIMITER //
CREATE PROCEDURE get_user(user_name varchar(50), user_password varchar(50))
BEGIN
	select * from users where username = user_name and pass = user_password;
END //
DELIMITER ;

DROP PROCEDURE IF EXISTS get_user_no_password;

DELIMITER //
CREATE PROCEDURE get_user_no_password(user_name varchar(50))
BEGIN
	select * from users where username = user_name;
END //
DELIMITER ;


-- END  ticket_db.php-------------------------------------------------------------------------------------------------------

-- START shows_db.php-------------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS get_show_by_showId;

DELIMITER //

CREATE PROCEDURE get_show_by_showId($showId int)
BEGIN
select * from shows where ShowID = '$showId';

END //

DELIMITER ;


DROP PROCEDURE IF EXISTS get_shows_by_month;

DELIMITER //

CREATE PROCEDURE get_shows_by_month($month int)
BEGIN
select * from Shows where month(ShowDate) = '$month' order by ShowDate;

END //

DELIMITER ;


DROP PROCEDURE IF EXISTS add_artist_to_show;

DELIMITER //

CREATE PROCEDURE add_artist_to_show($artist int, $show int, $headline varchar(20))
BEGIN
insert into Performance (ArtistID, ShowID, Headline) values ('$artist', '$show', '$headline');
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS remove_artist_from_show;

DELIMITER //

CREATE PROCEDURE remove_artist_from_show($artist int, $show int)
BEGIN
delete from Performance where ArtistID = '$artist' and ShowID = '$show';
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS shows_for_artist_before_given_date;

DELIMITER //

CREATE PROCEDURE shows_for_artist_before_given_date($artistID int, $showDate date)
BEGIN
select * from Performance natural join Shows where ArtistID = '$artistID' and ShowDate < '$showDate';
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS find_similar_artists;

DELIMITER //

CREATE PROCEDURE find_similar_artists(artistID int)
BEGIN
select * from Artist where Genre = (select Genre from Artist where ArtistID = 'artistID');
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS number_times_headlined;

DELIMITER //

CREATE PROCEDURE number_times_headlined(artistID int)
BEGIN
select count(*), Headline from Performs where ArtistID = artistID  group by Headline;
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS shows_before_today;

DELIMITER //

CREATE PROCEDURE shows_before_today($artistID int)
BEGIN
select * from shows join Venue using (VenueID) where ShowDate < NOW();
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS shows_after_today;

DELIMITER //

CREATE PROCEDURE shows_after_today($artistID int)
BEGIN
select * from shows join Venue using (VenueID) where ShowDate >= NOW();
END //

DELIMITER ;

-- END shows_db.php-------------------------------------------------------------------------------------------------------

-- StART venue_db.php-------------------------------------------------------------------------------------------------------
DROP PROCEDURE IF EXISTS get_average_venue_capacity;

DELIMITER //

CREATE PROCEDURE get_average_venue_capacity($artistID int)
BEGIN
select avg(Capacity) from Performs natural join Shows natural join Venue where ArtistID = '$artistID';
END //

DELIMITER ;

DROP PROCEDURE IF EXISTS add_show;

DELIMITER //

CREATE PROCEDURE add_show(showname varchar(100), showdate DATE , ticketPrice int, venueID int)
BEGIN
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) VALUES ('showname', showdate, ticketPrice, venueID);
END //

DELIMITER ;

-- END venue_db.php-------------------------------------------------------------------------------------------------------

-- StART Performs_db) -----------------------------------------------------------------------------------------------------

DROP PROCEDURE IF EXISTS get_headliner;

DELIMITER //

CREATE PROCEDURE get_headliner($showid int)
BEGIN
select ArtistName from Shows join Performs using (ShowID) join Artist using (ArtistID)
where Shows.ShowID = $showid and Headline = 'Headline';
END //

DELIMITER ;


DROP PROCEDURE IF EXISTS get_opener;

DELIMITER //

CREATE PROCEDURE get_opener($showid int)
BEGIN
select ArtistName  from Shows join Performs using (ShowID) join Artist using (ArtistID)
where Shows.ShowID = $showid and Headline = 'Opener';
END //

DELIMITER ;

-- END Performs_db.php) -----------------------------------------------------------------------------------------------------




insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Coldplay', '2017-12-23' , 80, 2);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Imagine Dragons', '2017-11-10' , 80 , 2);
insert into Shows (ShowName, ShowDate, TicketPrice, VenueID) values ('Oasis', '2017-10-02' , 30 , 2);


-- Start Location Calculation -----
DROP PROCEDURE IF EXISTS get_lat_and_long;

DELIMITER //

CREATE PROCEDURE get_lat_and_long(user1_ID int, user2_ID int)
BEGIN
	DECLARE user1_lat FLOAT;
    DECLARE user1_long FLOAT;
    DECLARE user2_lat FLOAT;
    DECLARE user2_long FLOAT;
    
    select Latitude, Longitude
		into user1_lat, user1_long
			from Users
				where UserId = user1_ID;
                
	select Latitude, Longitude
		into user2_lat, user2_long
			from Users
				where UserId = user2_ID;
    
    select user1_lat, user1_long, user2_lat, user2_long;
    
END //

DELIMITER ;

-- End Location Calculation --





