CREATE DATABASE recipedb;
\c recipedb

CREATE TABLE measurment
(
	id SERIAL PRIMARY KEY,
	lable VARCHAR(100) NOT NULL UNIQUE
);

\d measurment

CREATE TABLE ingredient
(
	id SERIAL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	measurment_id INT NOT NULL REFERENCES measurment(id),
	UNIQUE(name, measurment_id)
);

\d ingredient

CREATE TABLE recipe
(
	id SERIAL PRIMARY KEY,
	title VARCHAR(100) NOT NULL UNIQUE,
	instruction TEXT NOT NULL,
	last_used DATE
);

\d recipe

CREATE TABLE pantry
(
	id SERIAL PRIMARY KEY,
	ingredient_id INT NOT NULL REFERENCES ingredient(id),
	quantity INT NOT NULL DEFAULT 0
);

\d pantry

CREATE TABLE recipe_ingredient
(
	id SERIAL PRIMARY KEY,
	ingredient_id INT NOT NULL REFERENCES ingredient(id),
	recipe_id INT NOT NULL REFERENCES recipe(id),
	quantity_needed NUMERIC(10,3) NOT NULL DEFAULT 0
);

\d recipe_ingredient

INSERT INTO measurment(lable) VALUES ('teaspoon (tsp)');
INSERT INTO measurment(lable) VALUES ('tablespoon (tbsp, T or tbs)');
INSERT INTO measurment(lable) VALUES ('fluid ounce (fl oz)');
INSERT INTO measurment(lable) VALUES ('cup (c)');
INSERT INTO measurment(lable) VALUES ('pint (pt or p)');
INSERT INTO measurment(lable) VALUES ('quart (q or qt');
INSERT INTO measurment(lable) VALUES ('gallon (g or gal');
INSERT INTO measurment(lable) VALUES ('millilitter (ml)');
INSERT INTO measurment(lable) VALUES ('liter (l)');
INSERT INTO measurment(lable) VALUES ('pound (lb)');
INSERT INTO measurment(lable) VALUES ('ounce (oz)');
INSERT INTO measurment(lable) VALUES ('milligram (mg)');
INSERT INTO measurment(lable) VALUES ('gram (g)');
INSERT INTO measurment(lable) VALUES ('kilogram (kg)');
INSERT INTO measurment(lable) VALUES ('millimeter (mm)');
INSERT INTO measurment(lable) VALUES ('centimeter (cm)');
INSERT INTO measurment(lable) VALUES ('meter (m)');
INSERT INTO measurment(lable) VALUES ('inch (in)');
INSERT INTO measurment(lable) VALUES ('');
INSERT INTO measurment(lable) VALUES ('large');
INSERT INTO measurment(lable) VALUES ('medium');
INSERT INTO measurment(lable) VALUES ('small');

SELECT * FROM measurment;

INSERT INTO ingredient(name, measurment_id) VALUES ('vegetable oil','2');
INSERT INTO ingredient(name, measurment_id) VALUES ('onion, chopped', '19');
INSERT INTO ingredient(name, measurment_id) VALUES ('frozen chopped spinach', '11');
INSERT INTO ingredient(name, measurment_id) VALUES ('egg, beaten', '20');
INSERT INTO ingredient(name, measurment_id) VALUES ('cheese, shredded Muenster', '4');
INSERT INTO ingredient(name, measurment_id) VALUES ('salt', '1');
INSERT INTO ingredient(name, measurment_id) VALUES ('ground black pepper', '1');

SELECT * FROM ingredient;

INSERT INTO recipe(title, instruction) VALUES ('Crustless Spinach Quiche', '1. Preheat oven to 350 degrees F (175 degrees C). Lightly grease a 9 inch pie pan.
2. Heat oil in a large skillet over medium-high heat. Add onions and cook, stirring occasionally, until onions are soft. Stir in spinach and continue cooking until excess moisture has evaporated.
3. In a large bowl, combine eggs, cheese, salt and pepper. Add spinach mixture and stir to blend. Scoop into prepared pie pan.
4. Bake in preheated oven until eggs have set, about 30 minutes. Let cool for 10 minutes before serving.');

SELECT * FROM recipe;

INSERT INTO pantry(ingredient_id) VALUES ('1');
INSERT INTO pantry(ingredient_id) VALUES ('2');
INSERT INTO pantry(ingredient_id) VALUES ('3');
INSERT INTO pantry(ingredient_id) VALUES ('4');
INSERT INTO pantry(ingredient_id) VALUES ('5');
INSERT INTO pantry(ingredient_id) VALUES ('6');
INSERT INTO pantry(ingredient_id) VALUES ('7');

UPDATE pantry SET quantity = 100 WHERE ingredient_id = 1;
UPDATE pantry SET quantity = 2 WHERE ingredient_id = 2;
UPDATE pantry SET quantity = 2 WHERE ingredient_id = 3;
UPDATE pantry SET quantity = 12 WHERE ingredient_id = 4;
UPDATE pantry SET quantity = 15 WHERE ingredient_id = 5;
UPDATE pantry SET quantity = 100 WHERE ingredient_id = 6;
UPDATE pantry SET quantity = 100 WHERE ingredient_id = 7;

SELECT * FROM pantry;

INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('1', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('2', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('3', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('4', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('5', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('6', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id) VALUES ('7', '1');

UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 1;
UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 2;
UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 3;
UPDATE recipe_ingredient SET quantity_needed = 5 WHERE ingredient_id = 4;
UPDATE recipe_ingredient SET quantity_needed = 3 WHERE ingredient_id = 5;
UPDATE recipe_ingredient SET quantity_needed = 0.25 WHERE ingredient_id = 6;
UPDATE recipe_ingredient SET quantity_needed = 0.125 WHERE ingredient_id = 7;

SELECT * FROM recipe_ingredient;

SELECT * FROM measurment;
SELECT * FROM ingredient;
SELECT * FROM pantry;
SELECT * FROM recipe_ingredient;
SELECT * FROM recipe;
