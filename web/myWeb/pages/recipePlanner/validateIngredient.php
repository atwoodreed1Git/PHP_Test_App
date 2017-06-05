<?php 

include_once '../formValidation.php';

$quant = $qErr = $measure = $mErr = $ingredientName = $nErr = "";
$qValid = $mValid = $nValid = false;

// check the quantity
if (empty($_POST['quantity'])) {

	$qErr = "Quantity required";

} elseif (filter_var($_POST['quantity'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "([^0-9 /]+)")))) {
		
	$qErr = "Enter a valid quantity like 1/2, 1, or 1 1/2";

} else {

	$quant = test_input($_POST['quantity'], "[^0-9 /]+]");
	$qValid = true;
}

// check the measurement
if (empty($_POST['measurement'])) {

	$mErr = "Measurement is required";

} elseif (filter_var($_POST['measurement'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "/[^A-Za-z( ),]+/")))) {

		$mErr = "Please select a valid measurement";

} else {

	$measure = test_input($_POST['measurement'], "[^A-Za-z( ),]+");
	$mValid = true;
}

// check the ingredient name
if (empty($_POST['ingreName'])) {

	$nErr = "Ingredient Name is required";

} elseif (filter_var($_POST['ingreName'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp"=> "/[^A-Za-z ,-]+/")))) {

	$nErr = "Please enter a valid ingredient name that contains letters, spaces, commas, and -";

} else {

	$ingredientName = test_input($_POST['ingreName'], "[^A-Za-z ,-]+");
	$nValid = true;
}

?>