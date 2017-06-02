<?php 

include_once 'x.php';

function getMeasurements()
{
	global $db;

	$curRecipe = $db->prepare('SELECT * FROM measurement ORDER BY label;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurementList = getMeasurements();

include_once 'recipeHead.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
		<br>
		<div class=\"container card\">
			<form id=\"addRecipeID\" action=\"$baseDir" . "pages/recipePlanner/insertRecipe.php\" method=\"post\">
				<div class=\"card-content\">

				 	<h4>Recipe Title</h4>
				 	<input type=\"text\" name=\"newTitle\" id=\"newTitle\" >
					
					<h4>Ingredient</h4>
					<div class=\"row\">
						<div id=\"ingredientRow1\">
					 		<div class=\"col s3\">
							 	<label for=\"quantity\">Quantity</label>
						 		<input type=\"text\" name=\"quantity[]\">
					 		</div>
					 		
					 		<div class=\"col s4\">
					 			<label for=\"measurement\">Measurement Type</label>
					 			<select class=\"browser-default\" name=\"measurement[]\">
 ";

 foreach ($measurementList as $item) {
 	echo "									<option value=\"". $item['label'] ."\">" . $item['label'] . "</option>
 ";
 }

echo "								</select>
							</div>

							<div class=\"col s4\">
								<label for=\"newIngredient\">Ingredient Name</label>
						 		<input type=\"text\" name=\"ingreName[]\" >
					 		</div>
			
					 		<div id=\"btn1\" class=\"col s1\">
								<a href=\"#\" id=\"addI\" class=\"btn-floating btn-large waves-effect waves-light blue right\"><i class=\"large material-icons\">add</i></a>
					 		</div>

						</div>
					</div>

					<div>
					 	<h4>Instructions</h4>
					 	<textarea name=\"newInstruction\" class=\"materialize-textarea\" id=\"newInstruction\"></textarea>
					</div>
					
					<div>
						<h4>Recipe Reference</h4>
					 	<input type=\"text\" name=\"newReference\" id=\"newReference\"></input>
				 	</div>

				</div>
				
				<div class=\"card-action center\">
					<div class=\"row\">
				 		<div class=\"col s6\">
							<input type=\"submit\" name=\"submit\" value=\"Add Recipe\"></input>
						</div>

						<div class=\"col s6\">
							<input type=\"button\" onclick=\"clearRecipe();\" value=\"Reset\"></input>
						</div>
					</div>
				</div>
		 	</form>
		</div>
	</main>
</body>
</html>
";

 ?>