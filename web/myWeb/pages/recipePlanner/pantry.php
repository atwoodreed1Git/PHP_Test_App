<?php 

include_once 'x.php';
/******************************************************************
* 
******************************************************************/
function getPantryItems()
{
	global $db;

	$rID = $curID;

	$curRecipe = $db->prepare('SELECT quantity, lable, name FROM measurment m JOIN ingredient i ON m.id = i.measurment_id JOIN pantry p ON p.ingredient_id = i.id ORDER BY name;');

	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

function getMeasurments()
{
	global $db;

	$curRecipe = $db->prepare('SELECT lable FROM measurment ORDER BY lable;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurmentList = getMeasurments();
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

	echo $row['quantity'] . " " . $row['lable'] . " " . $row['name'] . "
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
					 			<label for=\"measurment\">Measurement Type</label>
					 			<select class=\"browser-default\" name=\"measurment\">
 ";

 foreach ($measurmentList as $item) {
 	echo "							<option value=\"". $item['lable'] ."\">" . $item['lable'] . "</option>
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



//								<input type=\"submit\" name=\"submit\" value\"+\" class=\"btn-floating btn-large waves-effect waves-light blue right\"></input>

?>