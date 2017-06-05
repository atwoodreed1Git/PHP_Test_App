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
	quantity VARCHAR(10) NOT NULL DEFAULT 0,
	UNIQUE(ingredient_id, quantity)
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
INSERT INTO measurement(label) VALUES ('slice');
INSERT INTO measurement(label) VALUES ('pinch');
INSERT INTO measurement(label) VALUES ('clove');
INSERT INTO measurement(label) VALUES ('sprig');

-- ADD INGREDIENTS
INSERT INTO ingredient(name, measurement_id) VALUES ('vegetable oil', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('onion, chopped', 1);
INSERT INTO ingredient(name, measurement_id) VALUES ('frozen chopped spinach', 12);
INSERT INTO ingredient(name, measurement_id) VALUES ('egg, beaten', 1);
INSERT INTO ingredient(name, measurement_id) VALUES ('cheese, shredded Muenster', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('salt', 2);
INSERT INTO ingredient(name, measurement_id) VALUES ('ground black pepper', 2);
INSERT INTO ingredient(name, measurement_id) VALUES ('beef broth', 12);
INSERT INTO ingredient(name, measurement_id) VALUES ('boneless pork ribs', 11);
INSERT INTO ingredient(name, measurement_id) VALUES ('barbecue sauce', 12);
INSERT INTO ingredient(name, measurement_id) VALUES ('white bread', 23);
INSERT INTO ingredient(name, measurement_id) VALUES ('butter, divided', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('Cheddar cheese', 23);
INSERT INTO ingredient(name, measurement_id) VALUES ('eggs', 1);
INSERT INTO ingredient(name, measurement_id) VALUES ('milk', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('ground cinnamon', 2);
INSERT INTO ingredient(name, measurement_id) VALUES ('bread', 23);
INSERT INTO ingredient(name, measurement_id) VALUES ('milk', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('brown sugar', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('ground nutmeg', 2);
INSERT INTO ingredient(name, measurement_id) VALUES ('ground cinnamon', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('uncooked elbow macaroni', 12);
INSERT INTO ingredient(name, measurement_id) VALUES ('shredded sharp Cheddar cheese', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('grated Parmesan cheese', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('butter', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('all-purpose flour', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('butter', 3);
INSERT INTO ingredient(name, measurement_id) VALUES ('breadcrumbs', 5);
INSERT INTO ingredient(name, measurement_id) VALUES ('paprika', 24);
INSERT INTO ingredient(name, measurement_id) VALUES ('skinless, boneless chicken breast halves', 1);
INSERT INTO ingredient(name, measurement_id) VALUES ('Swiss cheese', 23);
INSERT INTO ingredient(name, measurement_id) VALUES ('cooked ham', 23);
INSERT INTO ingredient(name, measurement_id) VALUES ('seasoned breadcrumbs', 5);

--  ADD 7 RECIPES
INSERT INTO recipe(title, instruction, reference) VALUES ('Crustless Spinach Quiche', '1. Preheat oven to 350 degrees F (175 degrees C). Lightly grease a 9 inch pie pan.
2. Heat oil in a large skillet over medium-high heat. Add onions and cook, stirring occasionally, until onions are soft. Stir in spinach and continue cooking until excess moisture has evaporated.
3. In a large bowl, combine eggs, cheese, salt and pepper. Add spinach mixture and stir to blend. Scoop into prepared pie pan.
4. Bake in preheated oven until eggs have set, about 30 minutes. Let cool for 10 minutes before serving.', 'Allrecipes.com, http://allrecipes.com/recipe/20876/crustless-spinach-quiche/');

INSERT INTO recipe(title, instruction, reference) VALUES ('BBQ Pork for Sandwiches', '1. Pour can of beef broth into slow cooker, and add boneless pork ribs. Cook on High heat for 4 hours, or until meat shreds easily. Remove meat, and shred with two forks. It will seem that its not working right away, but it will.
2. Preheat oven to 350 degrees F (175 degrees C). Transfer the shredded pork to a Dutch oven or iron skillet, and stir in barbeque sauce.
3. Bake in the preheated oven for 30 minutes, or until heated through.', 'http://allrecipes.com/recipe/21174/bbq-pork-for-sandwiches/');

INSERT INTO recipe(title, instruction, reference) VALUES ('Grilled Cheese Sandwich', '1. Preheat skillet over medium heat. Generously butter one side of a slice of bread. Place bread butter-side-down onto skillet bottom and add 1 slice of cheese. Butter a second slice of bread on one side and place butter-side-up on top of sandwich. Grill until lightly browned and flip over; continue grilling until cheese is melted. Repeat with remaining 2 slices of bread, butter and slice of cheese.', 'http://allrecipes.com/recipe/23891/grilled-cheese-sandwich/');

INSERT INTO recipe(title, instruction, reference) VALUES ('Ultimate French Toast', '1. Combine eggs, milk and cinnamon; beat well. Dip bread into egg mixture until completely coated.
2. Heat a lightly oiled griddle or frying pan over medium high heat. Cook bread slices until they are golden brown on both sides. Serve hot.', 'http://allrecipes.com/recipe/23186/ultimate-french-toast/');

INSERT INTO recipe(title, instruction, reference) VALUES ('French Toast II', '1. In a large mixing bowl, beat the eggs. Add the milk, brown sugar and nutmeg; stir well to combine.
2. Soak bread slices in the egg mixture until saturated.
3. Heat a lightly oiled griddle or frying pan over medium high heat. Brown slices on both sides, sprinkle with cinnamon and serve hot.', 'http://allrecipes.com/recipe/16719/french-toast-ii/');

INSERT INTO recipe(title, instruction, reference) VALUES ('Homemade Mac and Cheese', '1. Cook macaroni according to the package directions. Drain.
2. In a saucepan, melt butter or margarine over medium heat. Stir in enough flour to make a roux. Add milk to roux slowly, stirring constantly. Stir in cheeses, and cook over low heat until cheese is melted and the sauce is a little thick. Put macaroni in large casserole dish, and pour sauce over macaroni. Stir well.
3. Melt butter or margarine in a skillet over medium heat. Add breadcrumbs and brown. Spread over the macaroni and cheese to cover. Sprinkle with a little paprika.
4. Bake at 350 degrees F (175 degrees C) for 30 minutes. Serve.', 'http://allrecipes.com/recipe/11679/homemade-mac-and-cheese/');

INSERT INTO recipe(title, instruction, reference) VALUES ('Chicken Cordon Bleu I', '1. Preheat oven to 350 degrees F (175 degrees C). Coat a 7x11 inch baking dish with nonstick cooking spray.
2. Pound chicken breasts to 1/4 inch thickness.
3. Sprinkle each piece of chicken on both sides with salt and pepper. Place 1 cheese slice and 1 ham slice on top of each breast. Roll up each breast, and secure with a toothpick. Place in baking dish, and sprinkle chicken evenly with bread crumbs.
4. Bake for 30 to 35 minutes, or until chicken is no longer pink. Remove from oven, and place 1/2 cheese slice on top of each breast. Return to oven for 3 to 5 minutes, or until cheese has melted. Remove toothpicks, and serve immediately.', 'http://allrecipes.com/recipe/8495/chicken-cordon-bleu-i/');


--  ADD THE QUANTITY TO THE INGREDIENTS
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (1, 1, '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (2, 1, '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (3, 1, '10');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (4, 1, '5');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (5, 1, '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (6, 1, '1/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (7, 1, '1/8');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (8, 2, '14');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (9, 2, '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (10, 2, '18');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (11, 3, '4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (12, 3, '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (13, 3, '2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (14, 4, '4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (15, 4, '2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (16, 4, '1/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (17, 4, '8');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (14, 5, '4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (18, 5, '3/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (19, 5, '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (20, 5, '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (11, 5, '12');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (21, 5, '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (22, 6, '8');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (23, 6, '2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (24, 6, '1/2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (15, 6, '3');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (25, 6, '1/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (26, 6, '2 1/2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (27, 6, '2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (28, 6, '1/2');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (29, 6, '1');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (30, 7, '4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (6, 7, '1/4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (7, 7, '1/8');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (31, 7, '6');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (32, 7, '4');
INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (33, 7, '1/2');


--  ADD PANTRY
INSERT INTO pantry(ingredient_id, quantity) VALUES (1, 100);
INSERT INTO pantry(ingredient_id, quantity) VALUES (2, 2);
INSERT INTO pantry(ingredient_id, quantity) VALUES (3, 2);
INSERT INTO pantry(ingredient_id, quantity) VALUES (4, 12);
INSERT INTO pantry(ingredient_id, quantity) VALUES (5, 15);
INSERT INTO pantry(ingredient_id, quantity) VALUES (6, 100);
INSERT INTO pantry(ingredient_id, quantity) VALUES (7, 100);

--  SHOW ALL INFROMATION IN THE TABLE
SELECT * FROM measurement;
SELECT * FROM ingredient;
SELECT * FROM recipe_ingredient;
SELECT * FROM recipe;
SELECT * FROM pantry;

-- INSERT INTO measurement(label) VALUES ('');

-- INSERT INTO ingredient(name, measurement_id) VALUES ('', );
-- INSERT INTO recipe(title, instruction, reference) VALUES ('', '1. ', '');
-- INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (, , '');

-- INSERT INTO pantry(ingredient_id, quantity) VALUES (, );

-- modify the dates to show that they change
UPDATE recipe SET last_used='2011-01-01' WHERE id=1;
UPDATE recipe SET last_used='2012-04-10' WHERE id=2;
UPDATE recipe SET last_used='2015-06-15' WHERE id=3;
UPDATE recipe SET last_used='2016-06-20' WHERE id=4;
UPDATE recipe SET last_used='2000-10-30' WHERE id=5;
UPDATE recipe SET last_used='1900-11-03' WHERE id=6;
UPDATE recipe SET last_used='1988-12-05' WHERE id=7;

-- REMOVE ALL TABLES
-- DROP TABLE recipe, measurement, ingredient, pantry, recipe_ingredient;