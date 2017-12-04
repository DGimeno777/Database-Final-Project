DROP DATABASE IF EXISTS databasefinal;
CREATE DATABASE databasefinal;
use databasefinal;

create table Users
(
UserID INT PRIMARY KEY auto_increment,
UserName varchar(100),
Pass varchar(50),
UserType ENUM ('Artist', 'Customer', 'Venue')
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
Location varchar(100),

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


insert into Users (UserName, Pass, UserType) values ('U2', 'password1', 'Artist');
insert into Users (UserName, Pass, UserType) values ('Killers', 'password1', 'Artist');
insert into Users (UserName, Pass, UserType) values ('AlexC', 'password1', 'Artist');
insert into Users (UserName, Pass, UserType) values ('LanaBanana', 'password1', 'Artist');
insert into Users (UserName, Pass, UserType) values ('JAiko', 'password1', 'Artist');
insert into Users (UserName, Pass, UserType) values ('TD', 'password1', 'Venue');
insert into Users (UserName, Pass, UserType) values ('BOK', 'password1', 'Venue');
insert into Users (UserName, Pass, UserType) values ('HOB', 'password1', 'Venue');
insert into Users (UserName, Pass, UserType) values ('JHALL', 'password1', 'Venue');

insert into Venue (VenueName, Capacity, Location, UserID) values ('TD Garden', 19580, 'Boston', 6);
insert into Venue (VenueName, Capacity, Location, UserID) values ('Bok Center', 10, 'Boston', 7);
insert into Venue (VenueName, Capacity, Location, UserID) values ('House of Blues', 2500, 'Boston', 8);
insert into Venue (VenueName, Capacity, Location, UserID) values ('Jordan Hall', 1019, 'Boston', 9);

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


