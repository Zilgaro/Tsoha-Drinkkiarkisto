-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Player (name, password) VALUES ('Ano', 'Ano123');

INSERT INTO Drink (name, glass, drink_type, description) VALUES ('Tom Collins', 'Collins-lasi', 'Cocktail', 'Tom Collins on eräitä vanhimpia Amerikkalaisia cocktaileja, ensimmäistä kertaa kuvailtu vuonna 1876. Erittäin hyvä ja raikas peruscocktail kaikkiin tilanteisiin.');

INSERT INTO Ingredient(name) VALUES ('Gin', 'Brittiläinen, yleensä katajanmarjalla maustettu viina');
INSERT INTO Ingredient(name) VALUES ('Soodavesi', 'Hiilihapotettua, maustamatonta vettä');

INSERT INTO Recipe(drink_id, ingredient) VALUES (1, 'Gin');
INSERT INTO Recipe(drink_id, ingredient) VALUES (1, 'Soodavesi');

INSERT INTO Rating(client_id, drink_id, rating) VALUES (1,1,5.0); 