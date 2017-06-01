<?php 
session_start();

include_once 'x.php';

function getTitle($recipeID)
{
	global $db;
	
	$rID = $recipeID;

	$recipeName = $db->prepare('SELECT title, instruction, reference FROM recipe WHERE id=:id');
	$recipeName->bindParam(':id', $rID, PDO::PARAM_INT);

	$recipeName->execute();

	return $recipeName->fetch();
}

function getIngredients($curID)
{
	global $db;

	$rID = $curID;

	$curRecipe = $db->prepare('SELECT quantity_needed, lable, name FROM ingredient i JOIN recipe_ingredient ri ON i.id=ri.ingredient_id JOIN recipe r ON ri.recipe_id=r.id JOIN measurment m ON i.measurment_id=m.id WHERE r.id=:id;');

	$curRecipe->bindParam(':id', $curID, PDO::PARAM_INT);
	
	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$idList = array();
echo "<div class=\"center\">";

foreach ($listIDs as $i => $value) {
	$idList[] = $value['id'];
}

$curRecipeID = $idList[$randRecipe];
echo "</div>";

$recipeInfo = getTitle($curRecipeID);
$recipeIngredints = getIngredients($curRecipeID);

echo "		<div>
					<h3>". $recipeInfo['title'] ."</h3>
";

foreach ($recipeIngredints as $row) {

	echo $row['quantity_needed'] . " " . $row['lable'] . " " . $row['name'] . "
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