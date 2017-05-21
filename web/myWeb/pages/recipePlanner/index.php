<?php 

if (isset($_POST['newRecipe']))
{
	$randRecipe = rand(1,2);
}
else 
{
	$randRecipe = 1;	
}

include_once '../head.php';

echo "<body class=\"light-blue lighten-5\">";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main>
			<br>
";

include_once 'displayRecipe.php';

echo "		<div class=\"center\">
				<form name=\"newRecipe\" id=\"newRecipe\" method=\"post\">
					<input type=\"submit\" name=\"newRecipe\" value=\"Change Recipe\" onclick=\"return true\">	
				</form>
			<div>
		</main>
	</body>
</html>
";

?>