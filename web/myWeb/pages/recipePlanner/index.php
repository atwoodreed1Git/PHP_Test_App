<?php 

include_once '../head.php';

echo "<body>";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main class=\"light-blue lighten-5\">
			<br>
";

include_once 'displayRecipe.php';

echo "		</main>
	</body>
</html>
";

?>