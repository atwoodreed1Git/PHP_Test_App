<?php 

include_once 'x.php';

function getTitle($curTitle)
{
	global $db;

	$recipeName = $db->prepare('SELECT title, instruction FROM recipe WHERE id=:id');
	$recipeName->bindParam(':id', $rID);

	$rID = $curTitle;
	$recipeName->execute();

	//var_dump($recipeName->fetch());
	return $recipeName->fetch();
}
	

// function getIngredients($curIngredient)
// {
// 	global $db;

// 	$recipeName = $db->prepare('SELECT title FROM recipe WHERE id=:id');

// 	$rID = $curTitle;
// 	$recipeName->execute();

// 	//var_dump($recipeName->fetch());
// 	return $recipeName->fetchColumn();
// }

$recipeArray = getTitle(1);


echo "<h3>". $recipeArray['title'] ."</h3>";


echo "<p style=\"white-space: pre-wrap;\">". $recipeArray['instruction'] ."</p>";

// foreach ($db->query('SELECT * FROM ingredient') as $row) 
// {
//    echo "	<div>
// 			<h3>. "$row[''] .  ".$row['chapter'].":".$row['verse']."</span>
// 			 - \"" . $row['content'].".\"
// 		</div>
// ";
// } 

?>