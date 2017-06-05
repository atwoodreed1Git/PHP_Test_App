<?php 

session_start();

session_destroy();

include_once 'x.php';
include_once 'insertPantry.php';

/**************************************************************************************************
* get the list of items in the pantry
**************************************************************************************************/
function getPantryItems()
{
	global $db;

	$curRecipe = $db->prepare('SELECT quantity, label, name FROM measurement m JOIN ingredient i ON m.id = i.measurement_id JOIN pantry p ON p.ingredient_id = i.id ORDER BY name;');

	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

/**************************************************************************************************
* get the list of possible measurements
**************************************************************************************************/
function getMeasurements()
{
	global $db;

	$curRecipe = $db->prepare('SELECT label FROM measurement ORDER BY label;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurementList = getMeasurements();
$pantryItems = getPantryItems();

include_once 'recipeHead.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
	<br>
	<div class=\"container card-panel\">

		<h3>Pantry Items</h3>

		<table class=\"striped\">
			<thead>
				<tr>
					<th>Ingredient Name</th>
					<th>Quantity</th>
				</tr>
			</thead>

			<tbody>
";

foreach ($pantryItems as $row) {

	echo "				<tr>
					<td>" . $row['name'] . "</td>
					<td>" . $row['quantity'] . " " . $row['label'] . "</td>
				</tr>
";
}
?>
			</tbody>
		</table>
	</div>

	<br>
	<div class="container card-panel">

			<form id="addRecipeID" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
				<div class="row">
			 		<div class="col s3">
						<h4>Ingredient</h4>
					</div>

			 		<div class="col s9">
				   	<h6 class="red-text\">* all fields required.</h6>
					</div>
				</div>

				<div class="row">
			 		<div class="col s3">
					 	<label for="quantity">Quantity</label>
				 		<input type="text" name="quantity" value="<?php if (isset($_POST['quantity'])) echo $_POST['quantity']; ?>">
			 		</div>
			 		
			 		<div class="col s4">
			 			<label for="measurement">Measurement Type</label>
			 			<select class="browser-default" name="measurement">
			 			<option value="" disabled selected>Select a Measurement</option>
<?php

foreach ($measurementList as $item) {

 	echo "							<option value=\"". $item['label'] ."\">" . $item['label'] . "</option>
";
}

?>
							</select>
					</div>

					<div class="col s4">
						<label for="newIngredient">Ingredient Name</label>
				 		<input type="text" name="ingreName" value="<?php if (isset($_POST['ingreName'])) echo $_POST['ingreName']; ?>">
			 		</div>

			 		<div id="btn1" class="col s1">
						 <button type="submit" name="submit" value="submit" class="btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">add</i></button>
			 		</div>

			 		<div class="col s4">
				 		<span class="red-text"><?php echo $qErr; ?></span>
			 		</div>

			 		<div class="col s4">
				 		<span class="red-text"><?php echo $mErr; ?></span>
			 		</div>
			 		
			 		<div class="col s4">
				 		<span class="red-text"><?php echo $nErr; ?></span>
			 		</div>

				</div>
			</form>
		</div>
	</main>
</body>
</html>

?>