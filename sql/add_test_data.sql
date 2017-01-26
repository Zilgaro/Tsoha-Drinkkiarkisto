-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Client (name, password) VALUES ('Ano', 'Ano123');

INSERT INTO Drink (name, glass, drink_type, description) VALUES ('Tom Collins', 'Collins-lasi', 'Cocktail', 'Tom Collins on eräitä vanhimpia Amerikkalaisia cocktaileja, ensimmäistä kertaa kuvailtu vuonna 1876. Erittäin hyvä ja raikas peruscocktail kaikkiin tilanteisiin.');

INSERT INTO Ingredient(name, description) VALUES ('Gin', 'Brittiläinen, yleensä katajanmarjalla maustettu viina');
INSERT INTO Ingredient(name, description) VALUES ('Soodavesi', 'Hiilihapotettua, maustamatonta vettä');

INSERT INTO Recipe(drink_id, ingredient) VALUES (1, 'Gin');
INSERT INTO Recipe(drink_id, ingredient) VALUES (1, 'Soodavesi');

INSERT INTO Rating(client, drink, rating) VALUES (1,1,5.0); 