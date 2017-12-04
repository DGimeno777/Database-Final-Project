
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



DROP PROCEDURE IF EXISTS get_tickets_sold_by_showId;

DELIMITER //

CREATE PROCEDURE get_tickets_sold_by_showId($showId int)
BEGIN

 select count(*) as ticketcount from ticket WHERE ShowID = $showId;
 
END //

DELIMITER ;

-- CALL get_tickets_sold_by_showId(1)



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





