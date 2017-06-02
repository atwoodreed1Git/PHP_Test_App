<?php 

include_once 'x.php';
/******************************************************************
* 
******************************************************************/
function getPantryItems()
{
	global $db;

	$rID = $curID;

	$curRecipe = $db->prepare('SELECT quantity, label, name FROM measurement m JOIN ingredient i ON m.id = i.measurement_id JOIN pantry p ON p.ingredient_id = i.id ORDER BY name;');

	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

function getMeasurements()
{
	global $db;

	$curRecipe = $db->prepare('SELECT label FROM measurement ORDER BY label;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurementList = getMeasurements();
$pantryItems = getPantryItems();

include_once '../head.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
			<br>
			<div class=\"container card-panel\">
			<h3>Panrty Items</h3>
";

foreach ($pantryItems as $row) {

	echo $row['quantity'] . " " . $row['label'] . " " . $row['name'] . "
			<br>
";
}

echo "		<div>
				<form id=\"addRecipeID\" action=\"insertPantry.php\" method=\"get\">

				<h4>Ingredient</h4>
					 <div class=\"row\">
						<div id=\"ingredientRow1\">
					 		<div class=\"col s3\">
							 	<label for=\"quantity\">Quantity</label>
						 		<input type=\"text\" name=\"quantity\">
					 		</div>
					 		
					 		<div class=\"col s4\">
					 			<label for=\"measurement\">Measurement Type</label>
					 			<select class=\"browser-default\" name=\"measurement\">
 ";

 foreach ($measurementList as $item) {
 	echo "							<option value=\"". $item['label'] ."\">" . $item['label'] . "</option>
 ";
 }

echo "									</select>
							</div>

							<div class=\"col s4\">
								<label for=\"newIngredient\">Ingredient Name</label>
						 		<input type=\"text\" name=\"ingreName\" >
					 		</div>
					 		<div id=\"btn1\" class=\"col s1\">
								 <button type=\"submit\" name=\"submit\" class=\"btn-floating btn-large waves-effect waves-light blue right\"><i class=\"large material-icons\">add</i></button>
					 		</div>
						</div>
					</div>
				</form>
			</div>
			</div>
		</main>
	</body>
</html>
";

?>