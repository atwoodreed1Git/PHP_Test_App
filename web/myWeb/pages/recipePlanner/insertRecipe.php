<?php 
include_once 'x.php';

$message = "";

function getCurID() {
	try {
		global $db;

		$lastRecipeID = $db->prepare("SELECT currval('ingredient_id_seq');");

		$lastRecipeID->execute();

		return $lastRecipeID->fetch();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function getRecipeID($r_Name) {
	try {
		global $db;

		$currentRecipeID = $db->prepare("SELECT id FROM recipe WHERE title=:rT;");

		$currentRecipeID->bindParam(':rT', $r_Name, PDO::PARAM_STR);
		$currentRecipeID->execute();

		return $currentRecipeID->fetch();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function getIngredintID($i_Name) {
	try {
		global $db;

		$newIngID = $db->prepare("SELECT id FROM ingredient WHERE name=:i_n;");
		$newIngID->bindParam(':i_n', $i_Name, PDO::PARAM_STR);

		$newIngID->execute();
		return $newIngID->fetch();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function getRecipeName($m_ID, $recipeName) {
	try {
		global $db;

		$findName = $db->prepare('SELECT name FROM ingredient WHERE measurement_id=:mID and name=:rname;');

		$findName->bindParam(':mID', $m_ID, PDO::PARAM_INT);
		$findName->bindParam(':rname', $recipeName, PDO::PARAM_STR);
		
		$findName->execute();

		return $findName->fetch();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function getMeasurementID($me) {
	try {
		global $db;

		$findID = $db->prepare('SELECT id FROM measurement WHERE label=:measureLabel;');

		$findID->bindParam(':measureLabel', $me, PDO::PARAM_STR);
		
		$findID->execute();

		return $findID->fetch();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function addIngredintT($aName, $aMeasureID) {
	try {
		global $db;

		$toAdd = $db->prepare('INSERT INTO ingredient(name, measurement_id) VALUES (:a_n, :a_m_id)');

		$toAdd->bindParam(':a_n', $aName, PDO::PARAM_STR);
		$toAdd->bindParam(':a_m_id', $aMeasureID, PDO::PARAM_INT);
		
		$toAdd->execute();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

function addQuantityT($aIngreID, $aRecID, $aQuantity) {
	try {
		global $db;
		
		$toAddQ = $db->prepare('INSERT INTO recipe_ingredient(ingredient_id, recipe_id, quantity_needed) VALUES (:a_i_id, :a_r_id, :a_q);');

		$toAddQ->bindParam(':a_i_id', $aIngreID, PDO::PARAM_INT);
		$toAddQ->bindParam(':a_r_id', $aRecID, PDO::PARAM_INT);
		$toAddQ->bindParam(':a_q', $aQuantity, PDO::PARAM_STR);

		$toAddQ->execute();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

function addRecipeT($aTitle, $aInstruct, $aRef) {
	try {
		global $db;

		$toAddR = $db->prepare('INSERT INTO recipe(title, instruction, reference) VALUES (:a_t, :a_i, :a_r);');

		$toAddR->bindParam(':a_t', $aTitle, PDO::PARAM_STR);
		$toAddR->bindParam(':a_i', $aInstruct, PDO::PARAM_STR);
		$toAddR->bindParam(':a_r', $aRef, PDO::PARAM_STR);
		
		$toAddR->execute();
	}
	catch (PDOException $e) {
		$message .= "Error: " . $e->getMessage();
		die();
	}	
}

include_once 'recipeHead.php';

echo "<body>";

if (isset($_POST['submit']))
{
	global $db;
	$recipeTitle = $_POST['newTitle'];
	$quant = $_POST['quantity'];
	$measure = $_POST['measurement'];
	$ingredientsName = $_POST['ingreName'];
	$instruct = $_POST['newInstruction'];
	$reference = $_POST['newReference'];

	$isRecipeFound = getRecipeID($recipeTitle);

	if ($isRecipeFound)
	{
		$message .= "We already have a recipe with that name. Please rename and try again\n";
		header("Location: addRecipe.php");
		die();
		exit;
	}
	else {
		// we have a new recipe so lets add it; add title, instructions and reference
		addRecipeT($recipeTitle, $instruct, $reference);	
	}
	
	foreach ($ingredientsName as $key => $i_name) {
		// check to ensure the ingredient name is present
		
		// get the id of the measurement
		$measureID = getMeasurementID($measure[$key]);

		if (!$measureID)
		{
			$message .= "ID not found";
			header("Location: addRecipe.php");
			die();
			exit;
		}

		$ingredientName = getRecipeName($measureID[0], $i_name);

		$curI_ID = getIngredintID($i_name);
		$curRID = getRecipeID($recipeTitle);

		if ($ingredientName)
		{
			// the ingredint is already there so just update the quantity
		
			// add quantity to recipe_ingredient
			addQuantityT($curI_ID[0], $curRID[0], $quant[$key]);	
		}
		else
 		{
			// name and id are new add them 
 			addIngredintT($i_name, $measureID[0]);

			// modify the quantity
 			$cID = getCurID();
 			addQuantityT($cID[0], $curRID[0], $quant[$key]);	
		}	
	}
}

header("Location: addRecipe.php");
die();
exit;

echo $message;
echo "	</body>
</html>
";
?>