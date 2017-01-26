-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Client (
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Ingredient (
	name varchar(50) PRIMARY KEY NOT NULL,
	description Text
);

CREATE TABLE Drink (
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	glass varchar(50),
	drink_type varchar(50),
	description Text
);

CREATE TABLE Recipe (
	drink_id integer NOT NULL,
	ingredient varchar(50) NOT NULL,
	FOREIGN KEY(drink_id) REFERENCES Drink(id),
	FOREIGN KEY(ingredient) REFERENCES Ingredient(name)
);

CREATE TABLE Rating ( 	
	client integer NOT NULL,
	drink integer NOT NULL,
	rating float NOT NULL,
	FOREIGN KEY(client) REFERENCES Client(id),
	FOREIGN KEY(drink) REFERENCES Drink(id)
);