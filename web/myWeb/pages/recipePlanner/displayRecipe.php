<?php 

include_once 'x.php';

function getTitle($recipeID)
{
	global $db;

	$recipeName = $db->prepare('SELECT title, instruction FROM recipe WHERE id=:id');
	$recipeName->bindParam(':id', $rID);

	$rID = $recipeID;
	$recipeName->execute();

	//var_dump($recipeName->fetch());
	return $recipeName->fetch();
}
	

function getIngredients($curID)
{
	global $db;

	$rID = $curID;

	$curRecipe = $db->prepare('SELECT quantity_needed, lable, name FROM measurment as m, recipe_ingredient AS ri, recipe AS r, ingredient AS i WHERE m.id = i.measurment_id and r.id = :id and ri.id = i.id;');

	$curRecipe->bindParam(':id', $rID);
	
	$curRecipe->execute();

	//var_dump($recipeName->fetch());
	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$recipeInfo = getTitle(1);
$recipeIngredints = getIngredients(1);

echo "		<h3>". $recipeInfo['title'] ."</h3>
";

foreach ($recipeIngredints as $row) {

	echo $row['quantity_needed'] . " " . $row['lable'] . " " . $row['name'] . "
			<br>
";
}

echo "		<p style=\"white-space: pre-wrap;\">". $recipeInfo['instruction'] ."</p>";

?>