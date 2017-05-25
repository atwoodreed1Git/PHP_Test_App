<?php 
include_once 'x.php';

if (isset($_POST['submit']))
{
	$quant = $_POST['quantity'];
	$measure = $_POST['measurment'];
	$ingredientsName = $_POST['ingreName'];

	foreach ($ingredientsName as $key => $value) {
		// check to ensure the ingredient name is present
		$isFound = $db->prepare("SELECT measure_id FROM ingredient WHERE name = '" . $db->real_escape_string($ingredientsName[$key]) . "' LIMIT 1";)


		$isFound = $db->prepare("SELECT measure_id FROM ingredient WHERE name = :iname LIMIT 1";)

		$isFound->->bindParam(':id', $rID);
		$isFound->execute();
		$isFound->fetch();

		if ($isFound->num_rows == 0)
		{
			// insert
		}
		else
		{
			alert('This ingredient name already exists');
		}
	}
}

?>