<?php 

include_once 'x.php';

function updateDate ($currentRecipeID) {
	global $db;

	$qU = $db->prepare('UPDATE recipe SET last_used=CURRENT_DATE WHERE id=:uCid');
	$qU->bindParam(':uCid', $currentRecipeID, PDO::PARAM_INT);

	$qU->execute();
}

if (isset($_POST['makeRecipe']))
{
	// update date
	if (isset($_POST['cRecipeID']))
	{
		$randRecipe = $_POST['cRecipeID'];
	}

	if (isset($_POST['cRecipeIDIndex']))
	{
		updateDate($_POST['cRecipeIDIndex']);	
	}
}
else
	{
	if (isset($_POST['newRecipe']))
	{
		$randRecipe = rand(0,4);
	}
	else 
	{
		$randRecipe = rand(0,4);
	}
}

include_once '../head.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
			<br>
";

include_once 'displayRecipe.php';

echo "		<div class=\"row\">
				<div class=\"col s6 center\">
					<form name=\"makeRecipe\" id=\"makeRecipe\" method=\"post\">
						<input type=\"hidden\" name=\"cRecipeID\" value=\"".$randRecipe."\">
						<input type=\"hidden\" name=\"cRecipeIDIndex\" value=\"".$curRecipeID."\">
						<input type=\"submit\" name=\"makeRecipe\" value=\"Make Recipe\" onclick=\"\">	
					</form>
				</div>
				<div class=\"col s6 center\">
					<form name=\"newRecipe\" id=\"newRecipe\" method=\"post\">
						<input type=\"submit\" name=\"newRecipe\" value=\"Change Recipe\" onclick=\"return true\">	
					</form>
				</div>
			</div>
		</main>
	</body>
</html>
";

?>