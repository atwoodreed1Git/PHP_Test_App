<?php 

session_start();

include_once 'x.php';

/**************************************************************************************************
* gets the id's of the oldest 5 recipes
**************************************************************************************************/
function getListRecipesID() {
	global $db;

	$listRecipes = $db->prepare('SELECT id FROM recipe ORDER BY last_used ASC LIMIT 5;');

	$listRecipes->execute();

	return $listRecipes->fetchall(PDO::FETCH_NUM);
}

/**************************************************************************************************
* Update the date to the current date
**************************************************************************************************/
function updateDate($currentRecipeID) {
	global $db;

	$qU = $db->prepare('UPDATE recipe SET last_used=CURRENT_DATE WHERE id=:uCid');
	$qU->bindParam(':uCid', $currentRecipeID, PDO::PARAM_INT);

	$qU->execute();
}

// keep track of the list of recipes to display
if (isset($_SESSION['recipeIDList']) && !empty($_SESSION['recipeIDList'])) {

	if (isset($_POST['newRecipe']) && !empty($_POST['newRecipe'])) {

		// want a different recipe 
		$_SESSION['recipeIndex']++;
	}

	// we reached the end of the list and we need a new one
	if ($_SESSION['recipeIndex'] == 5) {
		
		$_SESSION['recipeIndex'] = 0;
		$_SESSION['recipeIDList'] = getListRecipesID();
	}
}
else {

	// first load the page
	$_SESSION['recipeIDList'] = getListRecipesID();
	$_SESSION['recipeIndex'] = 0;
}

$listIDs = $_SESSION['recipeIDList'];
$rIndex = $_SESSION['recipeIndex'];
$curRecipeID = $listIDs[$rIndex][0];

// determine which button was clicked
if (isset($_POST['makeRecipe']) && !empty($_POST['makeRecipe'])) {

	// update the date with the id
	updateDate($curRecipeID);	
}

include_once 'recipeHead.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
			<br>
			<div class=\"container card\">
				<div class=\"card-content\">
";

include_once 'displayRecipe.php';

echo "			</div>
			<div class=\"card-action\">
				<div class=\"row\">
					<div class=\"col s6 center\">
						<form name=\"makeRecipe\" id=\"makeRecipe\" method=\"post\" action=\"#\">
							<input type=\"submit\" name=\"makeRecipe\" value=\"Make Recipe\" onclick=\"return true\">	
						</form>
					</div>
					<div class=\"col s6 center\">
						<form name=\"newRecipe\" id=\"newRecipe\" method=\"post\" action=\"#\">
							<input type=\"submit\" name=\"newRecipe\" value=\"Change Recipe\" onclick=\"return true\">	
						</form>
					</div>
				</div>
			</div>
			</div>
		</main>
	</body>
</html>
";

?>