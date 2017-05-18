CREATE DATABASE events;
\c events

CREATE TABLE racer
(
	id SERIAL PRIMARY KEY,
	fName VARCHAR(100) NOT NULL,
	lName VARCHAR(100) NOT NULL,
	address VARCHAR(1000) NOT NULL,
	userName VARCHAR(100) NOT NULL UNIQUE
);

\d racer

CREATE TABLE race
(
	id SERIAL PRIMARY KEY,
	raceDate DATE NOT NULL,
	raceType VARCHAR(100) NOT NULL,
	location VARCHAR(1000) NOT NULL,
	name VARCHAR(100) NOT NULL
);

\d race

CREATE TABLE raceUser
(
	id SERIAL PRIMARY KEY,
 	raceID INT NOT NULL REFERENCES race(id),
 	racerID INT NOT NULL REFERENCES racer(id)
);

\d raceUser

INSERT INTO racer(fName, lName, address, userName) VALUES ('Bob', 'Doe','1234 bob st, Fun, ID 88888', 'bdoe');

select * from racer;
