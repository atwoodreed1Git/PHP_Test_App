<?php 

session_start();

include_once 'x.php';

/**************************************************************************************************
* gets the title, instruction, and reference of the current recipe
**************************************************************************************************/
function getTitle($recipeID)
{
	global $db;
	
	$recipeName = $db->prepare('SELECT title, instruction, reference FROM recipe WHERE id=:id');
	$recipeName->bindParam(':id', $recipeID, PDO::PARAM_INT);

	$recipeName->execute();

	return $recipeName->fetch();
}

/**************************************************************************************************
* gets the list of ingredients in the recipe
**************************************************************************************************/
function getIngredients($curID)
{
	global $db;

	$curRecipe = $db->prepare('SELECT quantity_needed, label, name FROM ingredient i JOIN recipe_ingredient ri ON i.id=ri.ingredient_id JOIN recipe r ON ri.recipe_id=r.id JOIN measurement m ON i.measurement_id=m.id WHERE r.id=:id;');

	$curRecipe->bindParam(':id', $curID, PDO::PARAM_INT);
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

// get the information for the current recipe and display it
$recipeInfo = getTitle($curRecipeID);
$recipeIngredints = getIngredients($curRecipeID);

echo "		<div>
					<h3>". $recipeInfo['title'] ."</h3>
";

foreach ($recipeIngredints as $row) {

	echo $row['quantity_needed'] . " " . $row['label'] . " " . $row['name'] . "
					<br>
";
}

echo "				<h5> Instruction </h5>
						<p style=\"white-space: pre-wrap;\">". $recipeInfo['instruction'] . "</p>
						<br>
						<p>From: " . $recipeInfo['reference'] . "</p> 
			</div>
";

?>