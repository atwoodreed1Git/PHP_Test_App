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

include_once '../head.php';

echo "<body>";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main class=\"light-blue lighten-5\">
			<br>
";

echo " 		<div class=\"container border\">
			<form action=\"\">
			 	<label for=\"newTitle\">Recipe Title</label>
			 	<input type=\"text\" name=\"newTitle\" id=\"newTitle\">
		
				<h6>Ingreient</h6>
			 	<div class=\"row\">
			 		<div class=\"col s4\">
					 	<label for=\"quantity\">Quantity</label>
				 		<input type=\"text\" name=\"quantity\" id=\"quantity\">
			 		</div>
			 		
			 		<div class=\"col s4\">
			 			<label for=\"measurment\">Measurement Type</label>
			 			<select id=\"measurment\" class=\"browser-default\" name=\"measurment\">
 ";

 foreach ($measurmentList as $item) {
 	echo "							<option value=\"". $item['lable'] ."\">" . $item['lable'] . "</option>
 ";
 }

echo "							</select>
						</div>

						<div class=\"col s4\">
							<label for=\"newIngredient\">Ingreient Name</label>
					 		<input type=\"text\" name=\"ingreName\" id=\"ingreName\">
				 		</div>
					</div>
				
				 	<label for=\"newInstruction\">Instructions</label>
				 	<textarea name=\"newInstruction\" row=\"20\" cols=\"50\" id=\"newInstruction\"></textarea>

			 	</form>
			</div>
		</main>
	</body>
</html>
";

 ?>

