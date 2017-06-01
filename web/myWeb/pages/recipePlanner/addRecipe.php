<?php 

include_once 'x.php';

function getMeasurments()
{
	global $db;

	$curRecipe = $db->prepare('SELECT * FROM measurment ORDER BY lable;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurmentList = getMeasurments();

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
					 			<label for=\"measurment\">Measurement Type</label>
					 			<select class=\"browser-default\" name=\"measurment[]\">
 ";

 foreach ($measurmentList as $item) {
 	echo "									<option value=\"". $item['lable'] ."\">" . $item['lable'] . "</option>
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