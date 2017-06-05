<?php 

session_start();

session_destroy();

include_once 'x.php';
include_once 'insertRecipe.php';

/**************************************************************************************************
* get the list of all measurements
**************************************************************************************************/
function getMeasurements()
{
	global $db;

	$curRecipe = $db->prepare('SELECT label FROM measurement ORDER BY label;');
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$measurementList = getMeasurements();

include_once 'recipeHead.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

?>
	<main>
	<br>

	<div class="container card">
		<form id="addRecipeID" action=" <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
			<div class="card-content">

			 	<h4>Recipe Title</h4>
			 	<input type="text" name="newTitle" value="<?php if (isset($_POST['newTitle'])) echo $_POST['newTitle']; ?>">
 				<span class="red-text"><?php echo $tErr; ?></span>

				
				<h4>Ingredient</h4>
				<div class="row">
					<div id="ingredientRow1">
				 		<div class="col s3">
						 	<label for="quantity">Quantity</label>
					 		<input type="text" name="quantity[]">
				 		</div>
				 		
				 		<div class="col s4">
				 			<label for="measurement">Measurement Type</label>
				 			<select class="browser-default" name="measurement[]">
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
					 		<input type="text" name="ingreName[]" >
				 		</div>
		
				 		<div id="btn1" class="col s1">
							<a href="#" id="addI" class="btn-floating btn-large waves-effect waves-light blue right"><i class="large material-icons">add</i></a>
				 		</div>

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

					<div>
					 	<h4>Instructions</h4>
					 	<textarea name="newInstruction" class="materialize-textarea" id="newInstruction" value="<?php if (isset($_POST['newInstruction'])) echo $_POST['newInstruction']; ?>"></textarea>
 				 		<span class="red-text"><?php echo $iErr; ?></span>
					</div>
					
					<div>
						<h4>Recipe Reference</h4>
					 	<input type="text" name="newReference" id="newReference" value="<?php if (isset($_POST['newReference'])) echo $_POST['newReference']; ?>"></input>
 				 		<span class="red-text"><?php echo $rErr; ?></span>
				 	</div>

				</div>
				
				<div class="card-action center">
					<div class="row">
				 		<div class="col s6">
							<input type="submit" name="submit" value="Add Recipe"></input>
						</div>

						<div class="col s6">
							<input type="button" onclick="clearRecipe();" value="Reset"></input>
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