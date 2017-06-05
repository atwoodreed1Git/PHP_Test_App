<?php 

/**************************************************************************************************
* gets the list of measurement id's for the drop down menu
**************************************************************************************************/
function getMeasurementID($me) {
	try {
		global $db;

		$findID = $db->prepare('SELECT id FROM measurement WHERE label=:measureLabel;');

		$findID->bindParam(':measureLabel', $me, PDO::PARAM_STR);
		
		$findID->execute();

		return $findID->fetch();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

/**************************************************************************************************
* gets the list of ingredient id's
**************************************************************************************************/
function getIngredintID($i_Name) {
	try {
		global $db;

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

/**************************************************************************************************
* adds a new ingredient and how it is measured
**************************************************************************************************/
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

/**************************************************************************************************
* add the quantity to the pantry
**************************************************************************************************/
function addPantryT($aIngreID, $aQuantity) {
	try {
		global $db;

		$toAddQ = $db->prepare('INSERT INTO pantry(ingredient_id, quantity) VALUES (:a_r_id, :a_q);');

		$toAddQ->bindParam(':a_r_id', $aIngreID, PDO::PARAM_INT);
		$toAddQ->bindParam(':a_q', $aQuantity, PDO::PARAM_STR);

		$toAddQ->execute();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

/**************************************************************************************************
* add the quantity to the pantry
**************************************************************************************************/
function inPantryT($aIngreID, $aQuantity) {
	try {
		global $db;
		
		$inPantry = $db->prepare('SELECT id FROM pantry WHERE ingredient_id=:r_id AND quantity=:q;');

		$inPantry->bindParam(':r_id', $aIngreID, PDO::PARAM_INT);
		$inPantry->bindParam(':q', $aQuantity, PDO::PARAM_STR);

		$inPantry->execute();

		return $inPantry->fetch();
	}
	catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
		die();
	}
}

/**************************************************************************************************
* Update the pantry quantity
**************************************************************************************************/
function updatePantryQantity($curI_ID, $newQantity) {
	global $db;

	$qU = $db->prepare('UPDATE pantry SET quantity=:n_q WHERE ingredient_id=:uCid;');

	$qU->bindParam(':uCid', $curI_ID, PDO::PARAM_INT);
	$qU->bindParam(':n_q', $newQantity, PDO::PARAM_STR);

	$qU->execute();
}

// error check the input
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	include_once 'validateIngredient.php';

	if ($qValid && $mValid && $nValid) {

		$mid = getMeasurementID($measure);

		if ($mid) {

			if (!$ingredientID) {

				// add new ingredient
				addIngredintT($ingredientName, $mid[0]);

				$newID = getIngredintID($ingredientName);
				addPantryT($newID[0], $quant);
			
			} else {

				// update pantry as long as it is not already in there
				if (!inPantryT($aIngreID, $aQuantity)) {
					
					addPantryT($ingredientID[0], $quant);

				} else {

					updatePantryQantity($ingredientID[0], $quant);
				}
			}
		}
	}
}

?>