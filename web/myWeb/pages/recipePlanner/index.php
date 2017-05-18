<?php 

include_once '../head.php';

echo "<body>";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main class=\"white\">
";

include_once 'displayRecipe.php';

echo "		</main>
	</body>
</html>
";

?>