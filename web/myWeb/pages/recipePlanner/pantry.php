<?php 

include_once 'x.php';

function getPantryItems()
{
	global $db;

	$rID = $curID;

	$curRecipe = $db->prepare('SELECT quantity, lable, name FROM measurment as m, pantry as p, ingredient AS i WHERE m.id = i.measurment_id and p.id = i.id ORDER BY name;');

	$curRecipe->execute();

	return $curRecipe->fetchall(PDO::FETCH_ASSOC);
}

$pantryItems = getPantryItems();

include_once '../head.php';

echo "<body>";

include_once '../headers/RecipePlannerHeader.php';
include_once '../menu.php';

echo "	<main class=\"light-blue lighten-5\">
			<br>
			<div class=\"center border\">
			<h3>Panrty Items</h3>
";

foreach ($pantryItems as $row) {

	echo $row['quantity'] . " " . $row['lable'] . " " . $row['name'] . "
			<br>
";
}

echo "		</div>
		</main>
	</body>
</html>
";

?>