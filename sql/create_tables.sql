-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Client(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Ingredient (
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	amount float NOT NULL,
);

CREATE TABLE Drink(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	glass varchar(50),
	drink_type varchar(50),
	ingredient integer NOT NULL,
	description varchar(500),
	FOREIGN KEY(ingredient) REFERENCES Ingredient(id),
);

CREATE TABLE Rating(
	
	client integer NOT NULL,
	drink integer NOT NULL,
	FOREIGN KEY(client) REFERENCES Client(id),
	FOREIGN KEY(drink) REFERENCES Drink(id),
);