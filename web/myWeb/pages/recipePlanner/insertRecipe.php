<?php 

include_once '../formValidation.php';

/**************************************************************************************************
* get the id of the current ingredient
**************************************************************************************************/
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

/**************************************************************************************************
* get the id of a recipe
**************************************************************************************************/
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

/**************************************************************************************************
* get the id of an ingredient
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
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

/**************************************************************************************************
* get the name of the recipe as long as the id's and the recipe names are unique
**************************************************************************************************/
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

/**************************************************************************************************
* get the id of a measurement base on the name
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
		$message .= "Error: " . $e->getMessage();
		die();
	}
}

/**************************************************************************************************
* add an ingredient to the list
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
* add the quantity of an ingredient in the list
**************************************************************************************************/
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

/**************************************************************************************************
* add the title, instructions, and reference to the list
**************************************************************************************************/
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

// error check
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$quant = array();
	$measure = array();
	$ingredientName = array();	
	$qValid = $mValid = $nValid = $tValid = $iValid = $rValid = false;

	$tErr = $iErr = $rErr = $title = $instruct = $reference = "";
	$qErr = $mErr = $nErr = "";

	$quantL = $_POST['quantity'];
	$measureL = $_POST['measurement'];
	$nameL = $_POST['ingreName'];
	// var_dump($measureL);

	// check the title
	if (empty($_POST['newTitle'])) {

		$tErr = "Title required";
		$tErr = "Quantity is required";


	} elseif (filter_var($_POST['newTitle'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "([^A-Za-z0-9 '&,-]+)")))) {
			
		$tErr = "Enter a valid Title that contains letters, spaces and these \'&,- symbols";

	} else {

		$title = test_input($_POST['newTitle'], "[^A-Za-z0-9 '&,-]+");

		$isRecipeFound = getRecipeID($title);

		if ($isRecipeFound)
		{
			$tErr = "We already have a recipe with that name. Please rename and try again\n";

		}	else {

			$tValid = true;
		}
	}

	// check the instruction
	if (empty($_POST['newInstruction'])) {

		$iErr = "Instructions required";

	} else {

		$instruct = test_input1($_POST['newInstruction']);
		$_POST['newInstruction'] = $instruct;
		$iValid = true;
	}

	//	check the reference
	if (empty($_POST['newReference'])) {

		$rErr = "Reference required";

	} else {

		$reference = test_input1($_POST['newReference']);
		$rValid = true;
	}

	foreach ($quantL as $i => $q) {

		if (empty($q[0])) {

			$qErr = "Quantity is required";
			$qValid = false;

		} elseif (filter_var($q[0], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "([^0-9 /]+)")))) {
				
			$qErr = "Enter a valid quantity like 1/2, 1, or 1 1/2";
			$qValid = false;

		} else {

			$quant = test_input($q[0], "[^0-9 /]+]");
			$qValid = true;
		}
	}

	foreach ($measureL as $i => $m) {

		// if (empty($m[0])) {
		// 	echo "fdsaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
		// 	$mErr = "Measurement is required";
		// 	$mValid = false;

		// } else
		if (filter_var($m[0], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "/[^A-Za-z( ),]+/")))) {
				
			$mErr = "Please select a valid measurement";
			$mValid = false;

		} else {
			
			$measure = test_input($m[0], "[^A-Za-z( ),]+");
			$mValid = true;
		}
		// echo " m[".$i. "] = ".$m[0] . "<br>";
	}


	foreach ($nameL as $i => $n) {

		if (empty($n[0])) {

			$nErr = "Ingredient Name is required";
			$nValid = false;

		} elseif (filter_var($n[0], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "/[^A-Za-z ,-]+/")))) {
				
			$nErr = "Please enter a valid ingredient name that contains letters, spaces, commas, and -";
			$nValid = false;

		} else {

			$ingredientsName = test_input($n[0], "[^A-Za-z ,-]+");
			$nValid = true;
		}
	}



	if ($qValid && $mValid && $nValid && $tValid && $iValid && $rValid) {

		$isRecipeFound = getRecipeID($title);

		if (!$isRecipeFound)	{

			// we have a new recipe so lets add it; add title, instructions and reference
			addRecipeT($title, $instruct, $reference);	
		}
		
		foreach ($ingredientsName as $key => $i_name) {
			// check to ensure the ingredient name is present
			
			// get the id of the measurement
			$measureID = getMeasurementID($measure[$key]);

			if ($measureID) {

				$ingredientName = getRecipeName($measureID[0], $i_name);

				$curI_ID = getIngredintID($i_name);
				$curRID = getRecipeID($title);

				if ($ingredientName) {

					// the ingredient is already there so just update the quantity
				
					// add quantity to recipe_ingredient
					addQuantityT($curI_ID[0], $curRID[0], $quant[$key]);

				} else {

					// name and id are new add them 
		 			addIngredintT($i_name, $measureID[0]);

					// modify the quantity
		 			$cID = getCurID();
		 			addQuantityT($cID[0], $curRID[0], $quant[$key]);	
				}	
			}
		}
	}
}

?>