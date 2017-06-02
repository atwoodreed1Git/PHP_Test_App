CREATE DATABASE recipedb;
\c recipedb

CREATE TABLE measurement
(
	id SERIAL PRIMARY KEY,
	label VARCHAR(100) NOT NULL UNIQUE
);

\d measurement

CREATE TABLE ingredient
(
	id SERIAL PRIMARY KEY,
	name VARCHAR(100) NOT NULL,
	measurement_id INT NOT NULL REFERENCES measurement(id),
	UNIQUE(name, measurement_id)
);

\d ingredient

CREATE TABLE recipe
(
	id SERIAL PRIMARY KEY,
	title VARCHAR(100) NOT NULL UNIQUE,
	instruction TEXT NOT NULL,
	last_used DATE NOT NULL DEFAULT CURRENT_DATE,
	reference VARCHAR(1000)
);

\d recipe

CREATE TABLE pantry
(
	id SERIAL PRIMARY KEY,
	ingredient_id INT NOT NULL REFERENCES ingredient(id),
	quantity VARCHAR(10) NOT NULL DEFAULT 0
);

\d pantry

CREATE TABLE recipe_ingredient
(
	id SERIAL PRIMARY KEY,
	ingredient_id INT NOT NULL REFERENCES ingredient(id),
	recipe_id INT NOT NULL REFERENCES recipe(id),
	quantity_needed VARCHAR(10) NOT NULL DEFAULT 0,
	UNIQUE(ingredient_id, recipe_id)
);

\d recipe_ingredient

--  ADD MEASUREMENTS
INSERT INTO measurement(label) VALUES ('');
INSERT INTO measurement(label) VALUES ('teaspoon (tsp)');
INSERT INTO measurement(label) VALUES ('tablespoon (tbsp, T or tbs)');
INSERT INTO measurement(label) VALUES ('fluid ounce (fl oz)');
INSERT INTO measurement(label) VALUES ('cup (c)');
INSERT INTO measurement(label) VALUES ('pint (pt or p)');
INSERT INTO measurement(label) VALUES ('quart (q or qt)');
INSERT INTO measurement(label) VALUES ('gallon (g or gal)');
INSERT INTO measurement(label) VALUES ('milliliter (ml)');
INSERT INTO measurement(label) VALUES ('liter (l)');
INSERT INTO measurement(label) VALUES ('pound (lb)');
INSERT INTO measurement(label) VALUES ('ounce (oz)');
INSERT INTO measurement(label) VALUES ('milligram (mg)');
INSERT INTO measurement(label) VALUES ('gram (g)');
INSERT INTO measurement(label) VALUES ('kilogram (kg)');
INSERT INTO measurement(label) VALUES ('millimeter (mm)');
INSERT INTO measurement(label) VALUES ('centimeter (cm)');
INSERT INTO measurement(label) VALUES ('meter (m)');
INSERT INTO measurement(label) VALUES ('inch (in)');
INSERT INTO measurement(label) VALUES ('large');
INSERT INTO measurement(label) VALUES ('medium');
INSERT INTO measurement(label) VALUES ('small');

SELECT * FROM measurement;

-- ADD INGREDIENTS
INSERT INTO ingredient(name, measurement_id) VALUES ('vegetable oil', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('onion, chopped', 1);
INSERT INTO ingredient(name, measurement_id) VALUES ('frozen chopped spinach', 11);
INSERT INTO ingredient(name, measurement_id) VALUES ('egg, beaten', '20');
INSERT INTO ingredient(name, measurement_id) VALUES ('cheese, shredded Muenster', '4');
INSERT INTO ingredient(name, measurement_id) VALUES ('salt', '1');
INSERT INTO ingredient(name, measurement_id) VALUES ('ground black pepper', '1');

SELECT * FROM ingredient;

--  ADD A RECIPE
INSERT INTO recipe(title, instruction, reference) VALUES ('Crustless Spinach Quiche', '1. Preheat oven to 350 degrees F (175 degrees C). Lightly grease a 9 inch pie pan.
2. Heat oil in a large skillet over medium-high heat. Add onions and cook, stirring occasionally, until onions are soft. Stir in spinach and continue cooking until excess moisture has evaporated.
3. In a large bowl, combine eggs, cheese, salt and pepper. Add spinach mixture and stir to blend. Scoop into prepared pie pan.
4. Bake in preheated oven until eggs have set, about 30 minutes. Let cool for 10 minutes before serving.', 'Allrecipes.com, http://allrecipes.com/recipe/20876/crustless-spinach-quiche/');

SELECT * FROM recipe;

--  ADD PANTRY
INSERT INTO pantry(ingredient_id, quantity) VALUES (1, 100);
INSERT INTO pantry(ingredient_id, quantity) VALUES (2, 2);
INSERT INTO pantry(ingredient_id, quantity) VALUES (3, 2);
INSERT INTO pantry(ingredient_id, quantity) VALUES (4, 12);
INSERT INTO pantry(ingredient_id, quantity) VALUES (5, 15);
INSERT INTO pantry(ingredient_id, quantity) VALUES (6, 100);
INSERT INTO pantry(ingredient_id, quantity) VALUES (7, 100);
SELECT * FROM pantry;
-- INSERT INTO pantry(ingredient_id, quantity) VALUES (8, 20);

-- UPDATE pantry SET quantity =  WHERE ingredient_id = 1;
-- UPDATE pantry SET quantity = HERE ingredient_id = 2;
-- UPDATE pantry SET quantity = HERE ingredient_id = 3;
-- UPDATE pantry SET quantity = WHERE ingredient_id = 4;
-- UPDATE pantry SET quantity = WHERE ingredient_id = 5;
-- UPDATE pantry SET quantity =  WHERE ingredient_id = 6;
-- UPDATE pantry SET quantity =  WHERE ingredient_id = 7;

SELECT * FROM pantry;

--  ADD THE QUANTITY TO THE INGREDIENTS
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('1', '1', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('2', '1', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('3', '1', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('4', '1', '5');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('5', '1', '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('6', '1', '1/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('7', '1', '1/8');

SELECT * FROM recipe_ingredient;

--  SHOW ALL INFROMATION IN THE TABLE
SELECT * FROM measurement;
SELECT * FROM ingredient;
SELECT * FROM recipe_ingredient;
SELECT * FROM recipe;
SELECT * FROM pantry;

-- GET THE INGREEDENTS FOR A RECIPE
SELECT quantity, label, name FROM measurement AS m, pantry AS p, ingredient AS i WHERE m.id = i.measurement_id and p.id = i.id ORDER BY name;
SELECT title FROM recipe ORDER BY last_used;

--	**************************************   new recipe  ********************************************  --

INSERT INTO ingredient(name, measurement_id) VALUES ('semisweet chocolate chips', '4');
INSERT INTO ingredient(name, measurement_id) VALUES ('Rice Krispies', '4');
INSERT INTO ingredient(name, measurement_id) VALUES ('chopped almonds', '4');

INSERT INTO recipe(title, instruction, reference) VALUES ('Chocolate Krisps', '1. Arrange 24 paper candy cups on a tray.
2. Place chocolate chips in a microwave-safe bowl; heat in the microwave until melted, about 2 minutes. Stir.
3. Stir crispy rice cereal and almonds into melted chocolate. Drop a spoonful of chocolate mixture into each candy cup. Refrigerate until set, 1 to 2 hours.', 'Allrecipes.com, http://allrecipes.com/recipe/232712/chocolate-krisps/');

INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('8', '2', '2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('9', '2', '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('10', '2', '1/2');

-- *****************************************           Get the next value in the recipe.  *******************************************--
-- SELECT nextval('recipe_id_seq');
-- SELECT currval('ingredient_id_seq');

-- INSERT INTO ingredient(name, measurement_id) VALUES ('peanut butter', '4');
-- SELECT id FROM ingredient WHERE name='peanut butter';

-- INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES ('6', '3', '1/4');
-- SELECT max(id) FROM ingredient;


-- SELECT name FROM ingredient WHERE measurement_id=2 and name='salt';

-- SELECT id FROM recipe WHERE title=:rT;
-- SELECT name FROM ingredient WHERE measurement_id=:mID and name=:rname

-- ***************************************     FIXES TO THE DATABASE   ****************************************************** --

-- ALTER TABLE recipe_ingredient DROP COLUMN quantity_needed;
-- ALTER TABLE recipe ALTER COLUMN last_used SET DEFAULT CURRENT_DATE;

-- ALTER TABLE recipe_ingredient ADD CONSTRAINT UNIQUE(ingredient_id, recipe_id);

--- TRUNCATE TABLE recipe_ingredient;	

----------------------------------------------- Modify recipe to have a reference -------------------------------------------------
-- ALTER TABLE recipe ADD COLUMN reference VARCHAR(1000);

-------------------------------------------------------- UPDATE information in database -------------------------------------------
-- UPDATE recipe SET reference = 'Allrecipes.com, http://allrecipes.com/recipe/20876/crustless-spinach-quiche/' WHERE id = 1;

-- UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 1;
-- UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 2;
-- UPDATE recipe_ingredient SET quantity_needed = 1 WHERE ingredient_id = 3;
-- UPDATE recipe_ingredient SET quantity_needed = 5 WHERE ingredient_id = 4;
-- UPDATE recipe_ingredient SET quantity_needed = 3 WHERE ingredient_id = 5;
-- INSERT INTO recipe_ingredient(quantity_needed) VALUES ('1/4') WHERE ingredient_id = 6;
-- UPDATE recipe_ingredient SET quantity_needed = '1/8' WHERE ingredient_id = 7;

-- DELETE FROM pantry WHERE id=8;

--INSERT INTO ingredient(name, measurement_id) VALUES ('white sugar', 4);

--INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (1, 1, '1/5');

SELECT id FROM recipe ORDER BY last_used DESC LIMIT 0, 3;


SELECT quantity_needed, label, name FROM measurement as m, recipe_ingredient AS ri, recipe AS r, ingredient AS i WHERE m.id = i.measurement_id and r.id = 1 and ri.id = i.id;

SELECT quantity_needed, label, name FROM ingredient i JOIN recipe_ingredient ri ON i.id=ri.ingredient_id JOIN recipe r ON ri.recipe_id=r.id JOIN measurement m ON i.measurement_id=m.id WHERE r.id = 1;


SELECT quantity, label, name FROM measurement m JOIN ingredient i ON m.id = i.measurement_id JOIN pantry p ON p.ingredient_id = i.id ORDER BY name;

UPDATE recipe SET last_used='2011-01-01' WHERE id=1;
UPDATE recipe SET last_used='2012-04-10' WHERE id=2;
UPDATE recipe SET last_used='2015-06-15' WHERE id=203;
UPDATE recipe SET last_used='2016-06-20' WHERE id=205;
UPDATE recipe SET last_used='2000-10-30' WHERE id=206;
UPDATE recipe SET last_used=CURRENT_DATE WHERE id=1;


DROP TABLE recipe, measurement, ingredient, pantry, recipe_ingredient;