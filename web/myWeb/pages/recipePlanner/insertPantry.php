<?php 

include_once 'x.php';

function getMeasurmentID($me) {
	try {
		global $db;

		$findID = $db->prepare('SELECT id FROM measurment WHERE lable=:measureLable;');

		$findID->bindParam(':measureLable', $me, PDO::PARAM_STR);
		
		$findID->execute();

		return $findID->fetch();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

function getIngredintID($i_Name) {
	try {
		global $db;
//echo "<h2>".$i_Name. "</h2>";
		$newIngID = $db->prepare("SELECT id FROM ingredient WHERE name=:i_n;");
		$newIngID->bindParam(':i_n', $i_Name, PDO::PARAM_STR);

		$newIngID->execute();
		return $newIngID->fetch();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

function addIngredintT($aName, $aMeasureID) {
	try {
		global $db;

		$toAdd = $db->prepare('INSERT INTO ingredient(name, measurment_id) VALUES (:a_n, :a_m_id)');

		$toAdd->bindParam(':a_n', $aName, PDO::PARAM_STR);
		$toAdd->bindParam(':a_m_id', $aMeasureID, PDO::PARAM_INT);
		
		$toAdd->execute();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

function addPantryT($aIngreID, $aQuantity) {
	try {
		global $db;
		$toAddQ = $db->prepare('INSERT INTO pantry(ingredient_id, quantity) VALUES (:a_r_id, :a_q);');

		$toAddQ->bindParam(':a_r_id', $aIngreID, PDO::PARAM_INT);
		$toAddQ->bindParam(':a_q', $aQuantity, PDO::PARAM_INT);

		$toAddQ->execute();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

echo "<!DOCTYPE html>
<html>
<head>
	<title>bob</title>
</head>
<body>
";

if (isset($_GET['submit']))
{
	global $db;
	$quant = $_GET['quantity'];
	$measure = $_GET['measurment'];
	$ingredientName = $_GET['ingreName'];

//echo "<h1>q = ". $quant . " m = " .$measure . " name = " . $ingredientName . "</h1>";

	$mid = getMeasurmentID($measure);

	if (!$mid)
	{

		header("Location: pantry.php?error=Please+select+a+valid+measurement.");
		die();
		exit;
	}

	$ingredientID = getIngredintID($ingredientName);
	
	if (!$ingredientID)
	{
		// add new ingredient
		addIngredintT($ingredientName, $mid[0]);

		$newID = getIngredintID($ingredientName);
		addPantryT($newID[0], $quant);
	}
	else
	{
		// update pantry
		addPantryT($ingredientID[0], $quant);
	}

//echo "<h1> m id = " . $ingredientID[0] . "</h1>";


}

header("Location: pantry.php?b=k");
die();
exit;
echo " insert recipe

</body>
</html>
";
?>



