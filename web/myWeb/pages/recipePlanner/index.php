<?php 
session_start();

include_once 'x.php';
/***************************************************************
* gets the id's of the oldest 5 recipes
****************************************************************/
function getListRecipesID() {
	global $db;

	$listRecipes = $db->prepare('SELECT id FROM recipe ORDER BY last_used DESC LIMIT 5;');

	$listRecipes->execute();

	return $listRecipes->fetchall(PDO::FETCH_ASSOC);
}

/***************************************************************
* Update the date to the current date
****************************************************************/
function updateDate ($currentRecipeID) {
	global $db;

	$qU = $db->prepare('UPDATE recipe SET last_used=CURRENT_DATE WHERE id=:uCid');
	$qU->bindParam(':uCid', $currentRecipeID, PDO::PARAM_INT);

	$qU->execute();
}

/***************************************************************
* keep track of the list of recipes to display
****************************************************************/
if (isset($_SESSION['recipeIDList']))
{
	$listIDs = $_SESSION['recipeIDList'];
}
else
{
	$IDs = getListRecipesID();
	$_SESSION['recipeIDList'] = $IDs;

}

/***************************************************************
* 
****************************************************************/
if (isset($_POST['makeRecipe'])) {
	
	// set the current index of the list of recipes 
	if (isset($_POST['cRecipeID']))
	{
		$randRecipe = $_POST['cRecipeID'];
	}

	if (isset($_POST['cRecipeIDIndex']))
	{
		// update the date with the id
		updateDate($_POST['cRecipeIDIndex']);	
	}
}
else {

	// randomly choose a recipe to display
	$randRecipe = rand(0,4);
}

include_once '../head.php';

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
						<form name=\"makeRecipe\" id=\"makeRecipe\" method=\"post\" action=\"#!\">
							<input type=\"hidden\" name=\"cRecipeID\" value=\"". $randRecipe ."\">
							<input type=\"hidden\" name=\"cRecipeIDIndex\" value=\"". $curRecipeID. "\">
							<input type=\"submit\" name=\"makeRecipe\" value=\"Make Recipe\">	
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