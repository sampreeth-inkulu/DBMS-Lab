CREATE TABLE Movie(
	movie_id int PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(50) NOT NULL,
    duration time,
    lang VARCHAR(20)
);

CREATE TABLE Cast_and_crew (
	id int PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    date_of_birth date,
    bio VARCHAR(200)
);

CREATE TABLE Movie_genre (
    movie_id int,
    genre VARCHAR(20) NOT NULL,
    PRIMARY KEY(movie_id, genre),
    FOREIGN KEY fk1(movie_id) REFERENCES Movie(movie_id)
);

CREATE TABLE Movie_boxoffice (
    movie_id int,
    no_of_weeks int,
    collection int,
    PRIMARY KEY(movie_id, no_of_weeks),
    FOREIGN KEY fk2(movie_id) REFERENCES Movie(movie_id)
);

CREATE TABLE Movie_links (
    movie_id int,
    related_links VARCHAR(100),
    PRIMARY KEY(movie_id, related_links),
    FOREIGN KEY fk3(movie_id) REFERENCES Movie(movie_id)
);

CREATE TABLE Part_of (
    movie_id int,
    id int,
    role VARCHAR(20),
    PRIMARY KEY(movie_id, id),
    FOREIGN KEY fk4(movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY fk5(id) REFERENCES Cast_and_crew(id)
);

CREATE TABLE Links (
    id int,
    related_links VARCHAR(100),
    PRIMARY KEY(id, related_links),
    FOREIGN KEY fk6(id) REFERENCES Cast_and_crew(id)
);

CREATE TABLE Award (
    award_id int PRIMARY KEY AUTO_INCREMENT,
    organisation VARCHAR(25),
    award_name VARCHAR(25),
    year int(4)
);

CREATE TABLE Awards_received (
    movie_id int,
    id int,
    award_id int,
    PRIMARY KEY(movie_id, id, award_id),
    FOREIGN KEY fk7(movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY fk8(id) REFERENCES Cast_and_crew(id),
    FOREIGN KEY fk9(award_id) REFERENCES Award(award_id)
);

CREATE TABLE User(
    email VARCHAR(50) PRIMARY KEY,
    password VARCHAR(32) NOT NULL
);

CREATE TABLE Reviews(
    movie_id int,
    email VARCHAR(50),
    rating int CHECK(rating > 0 and rating < 6),
    review VARCHAR(100),
	PRIMARY KEY(movie_id, email),
    FOREIGN KEY fk10(movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY fk11(email) REFERENCES User(email)    
);

CREATE TABLE Watchlist(
    movie_id int,
    email VARCHAR(50),
    PRIMARY KEY(movie_id, email),
    FOREIGN KEY fk12(movie_id) REFERENCES Movie(movie_id),
    FOREIGN KEY fk13(email) REFERENCES User(email)
);

CREATE TABLE Stanlist(
    email VARCHAR(50),
    id int,
    PRIMARY KEY(email, id),
    FOREIGN KEY fk14(email) REFERENCES User(email),
    FOREIGN KEY fk15(id) REFERENCES Cast_and_crew(id)
);
